<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotions', function (Blueprint $table) {
            $table->string('id', 36)->index();
            $table->string('user_id', 36)->index();
            $table->string('team_id',36)->index();
            $table->string('team_user_id', 36)->index();
            // TODO: カスタム絵文字対応
            $table->string('emoji', 100)->index();
            // TODO: max_length調べる
            $table->string('status_text', 100)->nullable();
            $table->text('memo')->nullable();
            $table->date('entered_on')->index();
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
        Schema::dropIfExists('emotions');
    }
}
