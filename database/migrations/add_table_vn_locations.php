<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
            $table->string('slug')->nullable()->index();
            $table->string('full_name', 255)->nullable();
            $table->string('full_path', 100)->nullable();
            $table->string('code', 20)->unique();
            $table->string('level', 20)->nullable();
            $table->string('parent_code', 20)->nullable();
        });

        $sqlFile = __DIR__ . '/vn_locations.sql';
        if (file_exists($sqlFile)) {
            DB::unprepared(file_get_contents($sqlFile));

            DB::table('vn_locations')
                ->whereNull('full_path')
                ->update(['full_path' => DB::raw('full_name')]);

            DB::table('vn_locations')->orderBy('id')->chunk(500, function ($locations) {
                foreach ($locations as $location) {
                    DB::table('vn_locations')
                        ->where('id', $location->id)
                        ->update(['slug' => Str::slug($location->full_path)]);
                }
            });
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
