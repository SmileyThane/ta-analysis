<?php

namespace App\Mail;

use App\Models\TaaRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaaResultsReady extends Mailable
{
    use Queueable, SerializesModels;

    public $taaRequest;

    public function __construct(TaaRequest $taaRequest)
    {
        $this->taaRequest = $taaRequest;
    }

    public function build()
    {
        return $this->view('results-ready')
            ->subject('Your TA Analysis Results Are Ready!')
            ->attachFromStorage($this->taaRequest->result_file_path, "TAA_Results_{$this->taaRequest->name}.pdf");
    }
}
