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
        Schema::create('tb_server', function (Blueprint $table) {
            $table->id();
            $table->string('no_rack');
            $table->string('rack_unit');
            $table->string('brand');
            $table->string('model');
            $table->string('serial_number');
            $table->string('application');
            $table->date('procurement_date');
            $table->date('acquition_date');
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
        Schema::dropIfExists('tb_server');
    }
};
