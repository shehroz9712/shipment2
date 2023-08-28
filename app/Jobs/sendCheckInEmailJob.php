<?php

namespace App\Jobs;

use App\Mail\CheckInNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendCheckInEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $attendance;
    protected $userName;

    public function __construct($attendance, $userName)
    {
        $this->attendance = $attendance;
        $this->userName = $userName;
    }


    public function handle()
    {

        // dd($this->userName, $this->attendance);
        Mail::to(['admin@kleinbott.com', 'zaeem@kleinbott.com'])->send(
            new CheckInNotification($this->userName, $this->attendance)
        );
    }
}