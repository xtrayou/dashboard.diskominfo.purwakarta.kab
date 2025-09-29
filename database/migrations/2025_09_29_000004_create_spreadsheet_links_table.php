<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('spreadsheet_links', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama deskripsi spreadsheet');
            $table->text('url')->comment('URL Google Sheets');
            $table->string('sheet_id')->nullable()->comment('ID sheet Google Sheets');
            $table->string('range')->default('A:Z')->comment('Range data yang diambil');
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spreadsheet_links');
    }
};
