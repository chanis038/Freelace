<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Solicitud;;

class sendemail extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud ; 
    public $sbj ='';
    public $introduction;
    public $owner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Solicitud $solicitud,$owner, $sbj,$introduction)
    {
        //
        $this->solicitud = $solicitud;
        $this->sbj = $sbj;
        $this->introduction= $introduction;
        $this->owner= $owner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('solicitudes.diged@profesor.usac.edu.gt')
                    ->subject( $this->sbj )
                    ->markdown('mails.sendemial');
    }
}
