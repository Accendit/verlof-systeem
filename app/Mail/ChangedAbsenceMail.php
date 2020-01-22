<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Absence;

class ChangedAbsenceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The changed Absence.
     * 
     * @var Absence
     */
    public $absence;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Absence $absence)
    {
        $this->absence = $absence;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.changedabsence')
                    ->subject($this->absence->isapproved? 'Uw verzoek is goedgekeurd!' : 'Uw verzoek is afgekeurd!');
    }
}
