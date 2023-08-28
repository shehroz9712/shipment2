<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MySQL database based on the database Env file or the provided name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schemaName = env('DB_DATABASE') ?: config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset", 'utf8mb4');
        $collation = config("database.connections.mysql.collation", 'utf8mb4_unicode_ci');

        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE $schemaName CHARACTER SET $charset COLLATE $collation;";

        try {
            DB::statement($query);
            config(["database.connections.mysql.database" => $schemaName]);
            return $this->info("Database(".$schemaName.") Create Successfully ~");
        } catch (\Throwable $th) {
            report($th);
            return $this->info("Cannot create database! Database (".$schemaName.") Already Exists");
        }

        return Command::SUCCESS;
    }
}
