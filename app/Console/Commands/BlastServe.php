<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BlastServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blasta:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the development server(s) for Blasta.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $server1 = popen('php artisan serve --port=8000', 'r');
        if ($server1) {
            $this->info('Server started on localhost port 8000');
        } else {
            $this->error('Something went wrong. Please check to ssee if port is already running.');
        }

        $server2 = popen('php artisan serve --port=8001', 'r');
        if ($server1) {
            $this->info('Server started on localhost port 8001');
        } else {
            $this->error('Something went wrong. Please check to ssee if port is already running.');
        }

        $front = popen('npm run dev', 'r');
        if ($front) {
            $this->info('Vite running');
        } else {
            $this->error('Something went wrong while running vite');
        }

        if ($server1 && $server2 && $front) {
            $this->info('ctrl + c to terminate server');
        }
    }
}
