<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $activationToken;

    // Konstruktor untuk mengirimkan user dan token
    public function __construct(User $user,$password, $activationToken)
    {
        $this->user = $user;
        $this->password = $password;
        $this->activationToken = $activationToken;
    }

    // Pengaturan tampilan email
    public function build()
    {
        return $this->view('pages.auth.account_activation')
                    ->with([
                        'name' => $this->user->name,
                        'user' => $this->user,
                        'password' => $this->password,
                        'activationUrl' => route('user.activate', $this->activationToken)
                    ]);
    }
}
