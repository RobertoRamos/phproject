<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueUpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('issue_id');
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('issue_update_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('update_id');
            $table->foreign('update_id')->references('id')->on('issue_updates');
            $table->string('field');
            $table->text('old_value');
            $table->text('new_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_updates');
        Schema::dropIfExists('issue_update_data');
    }
}
