<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('transactions', 'jatuh_tempo')) {
                $table->date('jatuh_tempo')->nullable()->after('tanggal_pinjam');
            }

            if (! Schema::hasColumn('transactions', 'denda_per_hari')) {
                $table->unsignedInteger('denda_per_hari')->default(0)->after('jatuh_tempo');
            }

            if (! Schema::hasColumn('transactions', 'hari_terlambat')) {
                $table->unsignedInteger('hari_terlambat')->default(0)->after('tanggal_kembali');
            }

            if (! Schema::hasColumn('transactions', 'total_denda')) {
                $table->unsignedInteger('total_denda')->default(0)->after('hari_terlambat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            foreach (['total_denda', 'hari_terlambat', 'denda_per_hari', 'jatuh_tempo'] as $column) {
                if (Schema::hasColumn('transactions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
