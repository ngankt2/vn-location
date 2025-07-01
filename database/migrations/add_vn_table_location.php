<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Wards
        Schema::create('vn_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('full_name', 255)->nullable();
            $table->string('full_path', 100)->nullable();
            $table->string('code', 20)->unique();
            $table->string('type', 20)->nullable();
            $table->string('parent_code', 20)->nullable();
        });

        $sqlFile = __DIR__ . '/_zi_vn_location_import.sql';
        if (file_exists($sqlFile)) {
            DB::unprepared(file_get_contents($sqlFile));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vn_locations');
    }
};
