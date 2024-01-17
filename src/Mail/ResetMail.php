<?php
/*
|---------------------------------------------------------------
| Password reset
|---------------------------------------------------------------
|
|
*/

namespace Ignitedcms\Ignitedcms\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->view('ignitedcms::emails.reset')->with([
            'url' => $this->url,
        ]);
    }
}
