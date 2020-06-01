<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoInformativo extends Mailable
{
    use Queueable, SerializesModels;

    // public $name = 'Pepe';

    private $name = 'Pepe';
    private $asunto = 'Correo informatico';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function setSubject($subject)
    {
        $this->subject = $subject;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.informativo')->subject($this->asunto)->with(['name2' => $this->name . '2']);                        // a esta vista le  puedes pasar datos , | declarar variables publicas 
    }

}
