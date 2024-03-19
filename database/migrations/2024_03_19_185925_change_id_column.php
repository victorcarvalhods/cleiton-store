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
        // Create a new temporary column
        DB::statement('ALTER TABLE users ADD COLUMN temp_id SERIAL PRIMARY KEY');

        // Drop the old id column
        DB::statement('ALTER TABLE users DROP COLUMN id');

        // Rename the new column to id
        DB::statement('ALTER TABLE users RENAME COLUMN temp_id TO id');
    }

    public function down(): void
    {
        // Reverse the process
        DB::statement('ALTER TABLE users RENAME COLUMN id TO temp_id');
        DB::statement('ALTER TABLE users ADD COLUMN id UUID');
        DB::statement('ALTER TABLE users DROP COLUMN temp_id');
    }
};
