<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckOutNotification;

class sendCheckOutEmailJob implements ShouldQueue
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
        // Customize the email content as per your requirements
        Mail::to(['admin@kleinbott.com', 'zaeem@kleinbott.com'])->send(
            new CheckOutNotification($this->userName, $this->attendance)
        );
    }
}