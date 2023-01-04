<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('external_server_id')->constrained('external_servers')->cascadeOnUpdate()->cascadeOnDelete();  //سرور خارجی
            $table->foreignId('creator_id')->constrained('users');  //ایجاد کننده
            $table->string('fileable_id');
            $table->string('fileable_type');
            $table->string('name'); //نام
            $table->string('mime_type'); //پسوند فایل
            $table->string('size'); //اندازه
            $table->string('original_name'); //نام اصلی
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
