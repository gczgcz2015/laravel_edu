<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_organization', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tid');
            $table->integer('oid');
            $table->integer('status'); // 邀请状态 0-邀请中 1-已加入 2-已拒绝
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
        Schema::dropIfExists('teacher_organization');
    }
}
