<?php

namespace App\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeConfirm extends Mailable
{
    use Queueable, SerializesModels;

    public int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Код подтверждения')
            ->view('Emails.CodeConfirm') // путь к Blade-шаблону
            ->with(['code' => $this->code]);
    }
}
