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
        Schema::create('tb_application', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pic')->nullable();
            $table->string('name');
            $table->string('function');
            $table->string('server');
            $table->string('modul');
            $table->string('programming_language');
            $table->string('version_language');
            $table->string('version_framework');
            $table->string('version_database');
            $table->string('server_database');
            $table->string('os_version');
            $table->string('information');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_application');
    }
};
