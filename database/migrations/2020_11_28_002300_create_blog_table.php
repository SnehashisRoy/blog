<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('slug')->unique()->index()->nullable();
			$table->string('meta_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('title');
            $table->text('content');
            $table->text('excerpt');
            $table->string('featured_image')->nullable();
            $table->integer('status')->default(0)->nullable();
			$table->softDeletes();
            $table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
			$table->string('name');
			$table->timestamps();
        });
        
        Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique()->index();
			$table->string('name');
			$table->timestamps();
        });
        
        Schema::create('blog_category', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('blog_id');
			$table->integer('category_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('blogs');
		Schema::dropIfExists('roles');
		Schema::dropIfExists('categories');
		Schema::dropIfExists('blog_category');
	}
}
