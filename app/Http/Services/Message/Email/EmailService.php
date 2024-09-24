<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{
    private $details;
    private $subject;
    private $from = [
        ['address' => null, 'name' => null]
    ];
    private $to;


    public function fire()
    {
        Mail::to($this->to)->send(new MailViewProvider($this->details, $this->subject, $this->from));
        return true;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return null[]
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @param null[] $from
     */
    public function setFrom($address, $name)
    {
        $this->from = [
            ['address' => $address, 'name' => $name]
        ];
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


}
