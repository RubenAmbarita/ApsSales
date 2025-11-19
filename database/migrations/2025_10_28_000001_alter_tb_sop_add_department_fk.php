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
        Schema::table('tb_sop', function (Blueprint $table) {
            // Tambahkan kolom id_department sebagai pengganti kolom owner
            $table->integer('id_department')->nullable()->after('retention_period');
            // Hapus kolom owner (string) karena akan digantikan oleh relasi ke tb_department
            if (Schema::hasColumn('tb_sop', 'owner')) {
                $table->dropColumn('owner');
            }
            // Opsional: tambahkan constraint FK jika diinginkan
            // Catatan: beberapa DB/driver mungkin memerlukan tipe/indeks khusus
            // Uncomment jika ingin menegakkan constraint
            // $table->foreign('id_department')->references('id')->on('tb_department')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_sop', function (Blueprint $table) {
            // Kembalikan kolom owner string
            if (!Schema::hasColumn('tb_sop', 'owner')) {
                $table->string('owner')->nullable()->after('retention_period');
            }
            // Hapus kolom id_department
            if (Schema::hasColumn('tb_sop', 'id_department')) {
                // $table->dropForeign(['id_department']); // jika FK diaktifkan
                $table->dropColumn('id_department');
            }
        });
    }
};