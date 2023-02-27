<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class LoginCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login to the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Enter your email');
        $password = $this->secret('Enter your password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            $this->info('Your token is: ' . $token);
        } else {
            $this->error('Invalid login credentials');
        }
    }
}
