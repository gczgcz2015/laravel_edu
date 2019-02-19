<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index(); // 创建机构的老师id
            $table->string('logo');
            $table->text('address');
            $table->string('bank');
            $table->string('bank_card');
            $table->integer('hot')->default(1); // 是否为热门机构 0-非热门 1-热门
            $table->float('score')->default(5); // 机构评分
            $table->unsignedInteger('status'); // 审核状态 0-审核中 1-审核成功 2-审核失败
            $table->text('reason'); // 审核不通过理由
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
        Schema::dropIfExists('organizations');
    }
}
