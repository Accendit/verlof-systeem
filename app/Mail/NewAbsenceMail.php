<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Absence;
use App\User;

class NewAbsenceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Absence request.
     * 
     * @var App\Absence
     */
    public $absence;

    /**
     * The submitter of the Absence request.
     * 
     * @var App\User
     */
    public $submitter_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Absence $absence)
    {
        $this->absence = $absence;
        $this->submitter_name = User::find($absence->submitter)->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nieuw verzoek ingedient!')
                    ->markdown('mail.newabsence');
    }
}
