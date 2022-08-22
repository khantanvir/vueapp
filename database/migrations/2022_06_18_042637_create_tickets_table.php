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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('priority')->nullable();
            $table->text('message')->nullable();
            $table->text('image')->nullable();
            $table->integer('create_by')->nullable();
            $table->integer('create_date')->nullable();
            $table->integer('reciever_id')->nullable();
            $table->tinyInteger('is_view')->nullable();
            $table->longText('discussion')->nullable();
            $table->text('url')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('deleted_at')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
