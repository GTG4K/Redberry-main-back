<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Scalar\String_;
use Ramsey\Uuid\Type\Integer;

class verifyEmailChangeRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private string $username;
    private string $newEmail;
    private int $userId;

    public function __construct(int $userId, string $username, string $newEmail)
    {
        $this->username = $username;
        $this->newEmail = $newEmail;
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.verify-email-change', ["username" => $this->username, "url" => $this->generateURL()]);
    }

    private function generateURL()
    {
        return env('BACKEND_URL') . "/api/user/" . $this->userId . "/verify_email_change?email=" . $this->newEmail;
    }
}
