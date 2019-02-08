<?php

use App\Score;
use Illuminate\Database\Seeder;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Score::create([
            'points' => 0.5394,
            'user_id' => '1',
        ]);

        factory(Score::class, 10)->create();

    }
}
