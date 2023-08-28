<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Support\GenerateFile;
use App\Console\Support\FileGenerator;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project Deployment with DB Create, Key Generate, Migration, Seeder, Passport Install, Link Storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path();
        $db = env('DB_DATABASE');
        try {
            $cp_env = shell_exec('copy .env.example .env');
            $this->info("Created : {$path}/.env");

            Artisan::call('key:generate');
            $this->info("Application key set successfully");

            Artisan::call('db:create '.$db);
            $this->info("Database created successfully DB: " . $db);

            Artisan::call('migrate:fresh');
            $this->info("Migrate fresh the data: ".$db);

        } catch (\Exception $e) {
            $this->error("File : {$e->getMessage()}");
            return E_ERROR;
        }
        return Command::SUCCESS;
    }
}
