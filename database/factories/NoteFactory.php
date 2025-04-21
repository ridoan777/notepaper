<?php

namespace Database\Factories;
use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$faker = Faker::create('en_US');
		return [
			'main_title' => $this->faker->sentence(3),
			'secondary_title' => $this->faker->sentence(2),
			'notes' => $this->faker->paragraphs(3, true),
	  ];
	}
}
