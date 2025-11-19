<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_lisensi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_vendor')->nullable();
            $table->string('software_name');
            $table->string('function');
            $table->string('license_key');
            $table->string('seats');
            $table->date('start_date');
            $table->date('expiry_date');
            $table->string('assigned_to');
            $table->string('status');
            $table->string('file');
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_lisensi');
    }
};
