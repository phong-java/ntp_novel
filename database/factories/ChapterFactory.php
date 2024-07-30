<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sChapter'=> $this->faker->word,
            'iChapterNumber' =>'122',
            'sContent' => $this->faker->sentence,
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
    }
}
