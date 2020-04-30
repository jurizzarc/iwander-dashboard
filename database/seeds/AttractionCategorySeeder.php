<?php

use Illuminate\Database\Seeder;

class AttractionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/attraction_category.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('attraction category table seeded!');
    }
}
