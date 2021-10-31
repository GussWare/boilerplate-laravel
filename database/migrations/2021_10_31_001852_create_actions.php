<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->text("description")->nullable();
            $table->boolean("enabled")->default(true);
            $table->unsignedInteger('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamp("createdAt");
            $table->timestamp("updatedAt");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
