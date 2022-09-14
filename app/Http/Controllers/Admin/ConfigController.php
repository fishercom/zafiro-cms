<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\ConfigRequest;

use App\Models\CmsConfig;

use View;
use Mail;
use Exception;

class ConfigController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$configs = CmsConfig::select()
			->Paginate();

        return view('admin.config.index', array('configs'=>$configs));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$config = CmsConfig::FindOrFail($id);

        return view('admin.config.edit', compact('config'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ConfigRequest $request, $id)
	{
		$config = CmsConfig::FindOrFail($id);
		$config->fill($request->all());
		$config->save();

		\App\Util\RegisterLog::add($config);
		return redirect('admin/config/');
	}


	public function google_oauth(){
		$base_path = base_path();
		$client = new \Google\Client();
		$client->setApplicationName('Gmail API Quickstart');
		$client->setScopes(\Google_Service_Gmail::GMAIL_SEND);
		$client->setAuthConfig($base_path.'/storage/app/credentials.json');
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');

		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = $base_path.'/storage/app/token.json';
		if (file_exists($tokenPath)) {
			$accessToken = json_decode(file_get_contents($tokenPath), true);
			$client->setAccessToken($accessToken);
		}

		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			    session()->flash('status', 'El token se ha refrescado!');

				return redirect('/admin/config/#token_refreshed');
			} else {
				return redirect($client->createAuthUrl());
			}
		}
		else{
		    session()->flash('status', 'El token está activo!');

			return redirect('/admin/config/#token_valid');        
		}
    }

	public function google_oauth_callback(){
		$base_path = base_path();
		$client = new \Google\Client();
		$client->setAuthConfig($base_path.'/storage/app/credentials.json');
		$client->authenticate($_GET['code']);
		$access_token = $client->getAccessToken();
		$client->setAccessToken($access_token);

		$token_json = json_encode($client->getAccessToken());
		$token_path = $base_path.'/storage/app/token.json';
		if (!file_exists(dirname($token_path))) {
			mkdir(dirname($token_path), 0700, true);
		}
		
		file_put_contents($token_path, $token_json);

		//dd($token_json);
		return redirect('/admin/config/#token_generated');
	}

	public function google_oauth_test(){
		$email = request('email');
		$subject = 'Google Test Mail';
		$content = 'Este es un correo de prueba, enviado desde el sitio web: <br>'.
			url()->previous();
		//$body = view('emails.default', ['subject' => $subject, 'content' => $content]);

		try{
			Mail::send('emails.default', ['subject' => $subject, 'content' => $content], function ($m) use ($subject, $email) {
				$m->to($email)->subject($subject);
			});
			session()->flash('status', 'Se ha enviado el correo!');
		}
		catch (Exception $ex){
			session()->flash('status', $ex->getMessage());
		}

		return redirect('/admin/config/#test_mail');
	}

}
