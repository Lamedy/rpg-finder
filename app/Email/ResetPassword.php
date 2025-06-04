<?php

namespace App\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Сброс пароля')
            ->view('Emails.PasswordReset')
            ->with(['url' => $this->url]);
    }
}
