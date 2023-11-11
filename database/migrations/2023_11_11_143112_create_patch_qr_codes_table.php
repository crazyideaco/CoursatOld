<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatchQrCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patchs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('count')->nullable();
            $table->timestamps();
        });

        Schema::create('patch_qr_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('website_student_id')->nullable()->unsigned()->index();
            $table->foreign('website_student_id')->references('id')->on('website_students')->onDelete('cascade');
            $table->nullableMorphs('patchable');
            $table->unsignedTinyInteger('status')->default(0)->comment('0: pending, 1: used, 2: expired');
            $table->unsignedInteger('patch_id')->nullable()->index();
            $table->foreign('patch_id')->references('id')->on('patchs')->onDelete('cascade');
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('qr_codes');
    }
}
