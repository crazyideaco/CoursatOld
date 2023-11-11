<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodesTable extends Migration
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
            $table->morphs('creatable');
            // $table->integer('user_id')->unsigned();

            $table->timestamps();
        });
        Schema::create('patch_qr_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('user_id')->unsigned();
            $table->morphs('creatable');
            $table->morphs('patchable');
            $table->unsignedInteger('patch_id')->nullable()->index();
            $table->unsignedTinyInteger('status')->default(0)->comment('0: pending, 1: used, 2: expired');

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
