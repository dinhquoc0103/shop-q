<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $id;
    protected $activationCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $id, $activationCode)
    {
        $this->name = $name;
        $this->id = $id;
        $this->activationCode = $activationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.EmailVerification')->with([
            "name" => $this->name,
            "id" => $this->id,
            "activationCode" => $this->activationCode,
        ]);
    }
}
