<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user, $url;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url) // USUARIO Y URL 
    {
        $this->user = $user;
        $this->url = $url;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $this->to($this->user); // llegaba dos veces a carmelo 
        $request->session()->put('op', 'verified');
         
         $messages = [
            'verified' => 'Usuario verificado, ya puede iniciar sesion',
        ];  
        
        $opSession = $request->session()->get('op');
        $alertMessage = null;

        if(isset($messages[$opSession])) {
            $alertMessage = $messages[$opSession];
        } else {
             $alertMessage = $opSession;
        }
        return $this->view('emails.verify')->with([
            'user' => $this->user, 
            'url' => $this->url,
            'alertMessage' => $alertMessage,
        ]);
    }
}
