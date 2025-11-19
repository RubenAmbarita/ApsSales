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
        Schema::create('tb_riwayatperawatan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_server')->nullable();
            $table->date('treatment_date');
            $table->string('treatment_type');
            $table->string('description');
            $table->string('cost');
            $table->string('long_warranty');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_riwayatperawatan');
    }
};
