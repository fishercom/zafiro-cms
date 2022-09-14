<?php

namespace App\Services\Mailer;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;

use Google_Client;
use Google_Service_Gmail;
use Google_Service_Gmail_Message;
use Google_Service_Gmail_Draft;

use Exception;

class GoogleMailerTransport extends Transport {

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */    
    private function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName(env('APP_NAME', 'Laravel App'));
        $client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
        $client->setAuthConfig(base_path().'/storage/app/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = base_path().'/storage/app/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        return $client;
    }

    /**
    * @param $sender string sender email address
    * @param $to string recipient email address
    * @param $subject string email subject
    * @param $messageText string email text
    * @return Google_Service_Gmail_Message
    */
    private function createMessage($sender, $to, $subject, $messageText, $headers=[]) {
        $message = new Google_Service_Gmail_Message();
        $boundary = uniqid(rand(), true);

        $rawMessageString = "From: <{$sender}>\r\n";
        $rawMessageString .= "To: <{$to}>\r\n"; //contacto@bravobanbif.com
        foreach($headers as $key=>$val){
            $rawMessageString .= "{$key}: {$val}\r\n";
        }
        $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n";
        $rawMessageString .= "\r\n--{$boundary}\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        $rawMessageString .= 'Content-Transfer-Encoding: 8bit' . "\r\n\r\n";
        //$rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $rawMessageString .= "{$messageText}\r\n";

        $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
        $message->setRaw($rawMessage);
        return $message;
    }
    
    /**
    * @param $service Google_Service_Gmail an authorized Gmail API service instance.
    * @param $user string User's email address or "me"
    * @param $message Google_Service_Gmail_Message
    * @return Google_Service_Gmail_Draft
    */
    private function createDraft($service, $user, $message) {
        $draft = new Google_Service_Gmail_Draft();
        $draft->setMessage($message);

        try {
            $draft = $service->users_drafts->create($user, $draft);
            print 'Draft ID: ' . $draft->getId();
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return $draft;
    }

    /**
    * @param $service Google_Service_Gmail an authorized Gmail API service instance.
    * @param $userId string User's email address or "me"
    * @param $message Google_Service_Gmail_Message
    * @return null|Google_Service_Gmail_Message
    */
    private function sendMessage($service, $userId, $message) {
        try {
            $message = $service->users_messages->send($userId, $message);
            //print 'Message with ID: ' . $message->getId() . ' sent.';
            return $message;
        } catch (Exception $e) {
            //print 'An error occurred: ' . $e->getMessage();
            return false;
        }

        return null;
    }
    
    /**
     * Send given email message
     * @param Swift_Mime_SimpleMessage $message
     * @param null $failedRecipients
     * @return int
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null): int {
        $this->beforeSendPerformed($message);

        $subject =  $message->getSubject();
        $to = key($message->getTo());
        $cc = $message->getCc();
        $bcc = $message->getBcc();
        //$priority = $message->getPriority();
        $body = $message->getBody();
        //$attachments = $message->getChildren();
        $headers=[];
        
        $client = $this->getClient();
        $service = new Google_Service_Gmail($client);
        $mailer = $service->users_messages;
        $userId = "me";
        $from = env('MAIL_FROM_ADDRESS', 'reconocimiento@bravobanbif.com'); //$from['email']
        $msg = $this->createMessage($from, $to, $subject, $body, $headers);
        $this->sendMessage($service, $userId, $msg);

        $this->sendPerformed($message);
        return $this->numberOfRecipients($message);

    }

}
