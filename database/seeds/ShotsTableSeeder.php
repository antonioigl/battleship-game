<?php

use App\Shot;
use Illuminate\Database\Seeder;

class ShotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Shot::class, 10)->create();
    }
}
