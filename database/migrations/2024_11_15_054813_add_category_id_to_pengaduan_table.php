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
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id'); // menambahkan kolom category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // menambahkan foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
        });
    }
};
