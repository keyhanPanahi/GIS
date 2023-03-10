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
        Schema::create('external_servers', function (Blueprint $table) {
            $table->id();
            $table->string('address');//آدرس هاست
            $table->string('username');//نام کاربری
            $table->string('password')->nullable();//رمز عببور
            $table->string('port')->nullable();//پورت
            $table->tinyInteger('status')->default(0);//وضعیت
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
        Schema::dropIfExists('external_servers');
    }
};
