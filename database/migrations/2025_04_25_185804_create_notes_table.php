<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('notes', function (Blueprint $table) {
			$table->id();
			$table->string('username');
			$table->string('main_title');
			$table->foreignId('g_id')->constrained('groups')->onDelete('cascade')->nullable();
			$table->string('group')->nullable();
			$table->string('font_family')->nullable();
			$table->string('font_size')->nullable();
			$table->string('line_height')->nullable();
			$table->string('slug');
			$table->string('meta_title')->nullable();
			$table->string('secondary_title')->nullable();
			$table->text('notes');
			$table->foreign('username')->references('username')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('notes');
	}
};
