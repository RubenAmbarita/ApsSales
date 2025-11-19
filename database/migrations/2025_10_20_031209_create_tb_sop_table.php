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
        Schema::create('tb_sop', function (Blueprint $table) {
            $table->id();
            $table->string('no_sop');
            $table->string('name');
            $table->string('version');
            $table->string('file');
            $table->string('retention_period');
            $table->string('owner');
            $table->date('effective_date');
            $table->string('approved_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sop');
    }
};
