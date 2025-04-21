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
			$table->string('user');
			$table->string('font_family');
			$table->string('font_size');
			$table->string('line_height');
			$table->string('main_title');
			$table->string('meta_title');
			$table->string('secondary_title')->nullable();
			$table->text('notes');
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
