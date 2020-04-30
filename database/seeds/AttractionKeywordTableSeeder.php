<?php

use Illuminate\Database\Seeder;

class AttractionKeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/attraction_keyword.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('attraction keywords table seeded!');
    }
}
