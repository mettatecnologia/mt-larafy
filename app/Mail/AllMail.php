<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Messages\MailMessage;

use App\Traits\TFile;

class AllMail extends Mailable
{
    use Queueable, SerializesModels, TFile;

    private $arquivo_caminho = null;

    public function __construct()
    {
        $this->arquivo_caminho  = '';
    }

    public function build()
    {
        $info = (new MailMessage)
            ->subject('Assunto!')
            ->line('Line')
            ->line('Line')
            ->line('Line');

        return $this->subject('Assunto!')
                    ->markdown('vendor.notifications.template')
                    ->with($info->toArray());
    }
}
