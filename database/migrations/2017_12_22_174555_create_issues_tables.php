<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 180)->unique();
            $table->enum('role', ['task', 'project', 'bug'])->default('task');
        });
        Schema::create('issue_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 180)->unique();
            $table->unsignedTinyInteger('closed')->default(0)->index();
            $table->unsignedTinyInteger('taskboard')->default(0)->index();
            $table->unsignedTinyInteger('taskboard_sort');
        });
        Schema::create('issue_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value')->index();
            $table->string('name', 180)->unique();
        });
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('issue_statuses');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('issue_types');
            $table->string('name');
            $table->string('size_estimate', 20);
            $table->text('description');
            $table->unsignedInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('issues');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->integer('priority');
            $table->foreign('priority')->references('value')->on('issue_priorities');
            $table->double('hours_total');
            $table->double('hours_remaining');
            $table->double('hours_spent');
            $table->string('repeat_cycle', 20);
            $table->date('start_date');
            $table->date('due_date');
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
        Schema::dropIfExists('issues');
        Schema::dropIfExists('issue_types');
        Schema::dropIfExists('issue_statuses');
        Schema::dropIfExists('issue_priorities');
    }
}
