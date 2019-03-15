<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmail as SendEmail;
use App\User as User;
use Mail;
use Illuminate\Support\Str;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $base;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($base, User $user)
    {
        $this->user = $user;
        $this->base = $base;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->token = Str::random(40);
        $this->user->save();

        $email = new SendEmail($this->base,$this->user->token);
        Mail::to($this->user['email'])->send($email);
    }
}
