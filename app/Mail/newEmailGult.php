<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newEmailGult extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Movimentação na Api');
        $this->from('pedro@hydradata.com.br', 'Pedro FullStack Laravel');

        $this->to($this->user->email, $this->user->name);
      

        return $this->markdown('email.email', [
            'user' => $this->user

        ]);
    }
}
