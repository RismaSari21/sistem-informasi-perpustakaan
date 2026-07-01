<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSqlite extends Command
{
    protected $signature = 'import:sqlite';

    protected $description = 'Import data dari SQLite ke PostgreSQL';

    public function handle()
    {
        $tables = [
            'users',
            'books',
            'members',
            'transactions',
        ];

        foreach ($tables as $table) {

            $this->info("Import tabel {$table}...");

            $rows = DB::connection('sqlite_import')
                ->table($table)
                ->get();

            if ($rows->isEmpty()) {
                $this->warn("Tidak ada data pada {$table}");
                continue;
            }

            DB::connection('pgsql')->table($table)->truncate();

            foreach ($rows as $row) {
                DB::connection('pgsql')
                    ->table($table)
                    ->insert((array) $row);
            }

            $this->info("Berhasil import {$rows->count()} data.");
        }

        $this->info('');
        $this->info('=================================');
        $this->info('IMPORT SELESAI');
        $this->info('=================================');

        return self::SUCCESS;
    }
}