<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;

class SmsService implements MessageInterface
{
    private $from;
    private $text;
    private $to;
    private $isFlash = true;

    public function fire()
    {
        $meliPayamak = new MeliPayamakService();
        return $meliPayamak->sendSms($this->from, $this->to, $this->text, $this->isFlash);
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from): void
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to): void
    {
        $this->to = $to;
    }

    /**
     * @return bool
     */
    public function getIsFlash(): bool
    {
        return $this->isFlash;
    }

    /**
     * @param bool $isFlash
     */
    public function setIsFlash(bool $isFlash): void
    {
        $this->isFlash = $isFlash;
    }
}
