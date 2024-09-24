<?php

namespace App\Http\Services\Message\SMS;

use Illuminate\Support\Facades\Config;

class MeliPayamakService
{
    private $username;
    private $password;

    public function __construct()
    {
        $this->username = Config::get('sms.username');
        $this->password = Config::get('sms.password');
    }

    public function sendSms($from, array $to, $text, $isFlash = true)
    {
        $parameters['username'] = $this->username;
        $parameters['password'] = $this->password;
        $parameters['from'] = $from;
        $parameters['to'] = $to;
        $parameters['text'] = $text;
        $parameters['isFlash'] = $isFlash;
        $parameters['udh'] = '';
        $parameters['recId'] = array(0);
        $parameters['status'] = 0x0;


    }

}
