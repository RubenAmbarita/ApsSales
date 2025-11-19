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
        Schema::create('tb_sfp', function (Blueprint $table) {
            $table->id();
            $table->integer('id_location')->nullable();
            $table->integer('id_vendor')->nullable();
            $table->integer('id_pic')->nullable();
            $table->string('name');
            $table->string('no_sfp');
            $table->string('attached_device');
            $table->string('attached_id');
            $table->string('attached_sn');
            $table->string('port_device');
            $table->string('bmn_code');
            $table->string('nup');
            $table->date('acquition_date');
            $table->date('year');
            $table->string('brand');
            $table->string('type');
            $table->string('serial_number');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sfp');
    }
};
