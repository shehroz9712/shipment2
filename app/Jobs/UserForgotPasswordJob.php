<?php

namespace App\Jobs;
use App\Models\PasswordReset;

use App\Mail\UserForgotPassword;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserForgotPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $userData;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($userData)
    {
        $this->userData = $userData;
    }
    /**
     * Execute the job.
     *
     * @return void
     */


    public function handle()
    {


        $code = rand(1000, 9999);

        if (PasswordReset::where('email', $this->userData['email'])->first()) {
            PasswordReset::where('email', $this->userData['email'])->update([
                'code' => $code,
                'created_at' => Carbon::now()
            ]);
        } else {
            PasswordReset::insert([
                'email' => $this->userData['email'],
                'code' => $code,
                'created_at' => Carbon::now()
            ]);
        }

        $this->userData['reset_code'] = $code;


        Mail::to($this->userData['email'])->send(
            new UserForgotPassword($this->userData)
        );
    }
}
