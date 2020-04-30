<?php

use Illuminate\Database\Seeder;
use App\Keyword;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $path = 'database/migrations/keywords.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('keywords table seeded!');
        // DB::table('keywords')->delete();
        //
        // $keywords = [
        //     [ 'name' => 'Budget-friendly' ],
        //     [ 'name' => 'Good for a Rainy Day' ],
        //     [ 'name' => 'Free Entry' ],
        //     [ 'name' => 'Good for Couples' ],
        //     [ 'name' => 'Good for Big Groups' ],
        //     [ 'name' => 'Honeymoon Spot' ],
        //     [ 'name' => 'Good for Kids' ],
        //     [ 'name' => 'Hidden Gems' ]
        // ];
        //
        // foreach ($keywords as $keyword) {
        //     Keyword::create($keyword);
        // }
    }
}
