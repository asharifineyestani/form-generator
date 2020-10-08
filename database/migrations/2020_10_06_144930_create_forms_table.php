<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{

    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('media_path')->nullable();
            $table->integer('price')->default(0);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade')->nullable();
            $table->foreignId('form_id')->onDelete('cascade');
            $table->json('body');
            $table->timestamps();
        });


        Schema::create('field_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->onDelete('cascade');
            $table->foreignId('form_id')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('field_form');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('options');
        Schema::dropIfExists('fields');
        Schema::dropIfExists('types');
        Schema::dropIfExists('forms');
    }
}
