<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition()
    {
        return [
            'content_type' => $this->faker->mimeType,
            'filename' => $this->faker->word . '.jpg',
            'encrypted_filename' => $this->faker->uuid . '.jpg',
            'is_sensitive' => $this->faker->boolean,
            'program_id' => Program::factory(),
        ];
    }
}
