<?php
namespace App\Util;

use Illuminate\Contracts\Config\Repository;

class Payme{

    private $config;
    private $url;
    private $acquirer_id;
    private $currency_code;
    private $commerce_id;
    private $commerce_secret;

    public function __construct()
    {
        $this->config = \Config::get('payme');
    }

    /**
     * This take the config/payme values and replace this class variables
     */
    private function configure()
    {
        foreach ($this->config as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function create_token($order_id, $amount)
    {
        try {
            $this->configure();
            $amount=round($amount, 2)*100;

            return openssl_digest("{$this->acquirer_id}{$this->commerce_id}{$order_id}{$amount}{$this->currency_code}{$this->commerce_secret}", 'sha512');

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Generate a payment order by token user
     *
     * @param null $tokenUser
     * @param int $purchaseUniqueId
     * @param float $purchaseTotal
     * @return bool|string
     */
    public function generatePaymentOrderByTokenUser($tokenUser = null, $purchaseUniqueId = 0, $purchaseTotal = 0.0)
    {
        if (is_null($tokenUser)) {
            return false;
        }

        $purchaseOperationNumber = sprintf('%06d', $purchaseUniqueId);
        $purchaseAmount = intval($purchaseTotal * 100);

        $purchaseVerificationCode = openssl_digest($this->acquirer_id . $this->commerce_id . $purchaseOperationNumber . $purchaseAmount . $this->currency_code . $this->vpos_secret_key, 'sha512');

        return $purchaseVerificationCode;
    }

}
