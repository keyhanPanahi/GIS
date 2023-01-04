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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('owner_fname'); //نام مالک
            $table->string('owner_lname'); //نام خانوادگی مالک
            $table->string('owner_nationalcode'); //کدملی مالک

            $table->dateTime('time'); //تاریخ و ساعت
            $table->text('point'); //مختصات
            $table->string('postal_code'); //کدپستی
            $table->json('postal_address');  //ادرس پستی
            $table->string('water_counter_number')->nullable(); //شماره کنتور اب
            $table->string('electric_counter_number')->nullable(); //شماره کنتور برق
            $table->string('gas_counter_number')->nullable(); //شماره کنتور گاز
            $table->json('phone'); //شماره تلفن

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnDelete(); //کاربر
            $table->foreignId('place_status_id')->constrained('place_statuses');//وضعبت مکان
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete()->cascadeOnDelete(); //نوع ملک
            $table->foreignId('usage_type_id')->constrained('usage_types')->cascadeOnDelete()->cascadeOnDelete(); //نوع کاربری
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};
