<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NovelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sCover'=> $this->faker->word,
            'sNovel'=> $this->faker->word,
            'sDes'=>$this->faker->sentence,
            'sProgress'=>'1',
            'iStatus'=>'1',
            'idUser'=>'45',
            'iLicense_Status'=>'1',
            'sLicense'=>$this->faker->word,
        ];
    }
}
