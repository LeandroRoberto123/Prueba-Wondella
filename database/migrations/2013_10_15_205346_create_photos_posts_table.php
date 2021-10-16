<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_post");
            $table->string('title_file')->nullable();
            $table->text('name_file');
            $table->string('type_file');
            $table->text('route_file');
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
        Schema::dropIfExists('files_posts');
    }
}
