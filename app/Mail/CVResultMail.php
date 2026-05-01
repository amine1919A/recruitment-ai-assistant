<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CVResultMail extends Mailable
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject('Résultat CV AI')
            ->view('emails.cv-result');
    }
}