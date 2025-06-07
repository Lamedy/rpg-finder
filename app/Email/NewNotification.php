<?php

namespace App\Email;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public User $sender;

    public function __construct(User $user, User $sender)
    {
        $this->user = $user;
        $this->sender = $sender;
    }

    public function build()
    {
        return $this->subject('Новое сообщение')
            ->view('Emails.NewNotification')
            ->with([
                'user' => $this->user,
                'sender' => $this->sender,
                'link' => route('account.notifications')
            ]);
    }
}
