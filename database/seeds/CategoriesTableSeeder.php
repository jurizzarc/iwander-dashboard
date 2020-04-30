<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $path = 'database/migrations/categories.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('categories table seeded!');
    //     DB::table('categories')->delete();
    //
    //     $categories = [
    //         [ 'name' => 'Sights & Landmarks'],
    //         [ 'name' => 'Monuments & Statues' ],
    //         [ 'name' => 'Churches & Cathedrals' ],
    //         [ 'name' => 'Architectural Buildings' ],
    //         [ 'name' => 'Historical Sites' ],
    //         [ 'name' => 'Neighbourhood' ],
    //         [ 'name' => 'Bridges' ],
    //         [ 'name' => 'Government Buildings' ],
    //         [ 'name' => 'Cemeteries' ],
    //         [ 'name' => 'Arenas & Stadiums' ],
    //         [ 'name' => 'Scenic Walking Areas' ],
    //         [ 'name' => 'Castles' ],
    //         [ 'name' => 'Observation Decks & Towers' ],
    //         [ 'name' => 'Museums' ],
    //         [ 'name' => 'Art Museums' ],
    //         [ 'name' => 'History Museums' ],
    //         [ 'name' => 'Science Museums' ],
    //         [ 'name' => 'Observatories & Planetariums' ],
    //         [ 'name' => 'National History Museums' ],
    //         [ 'name' => 'Theatres' ],
    //         [ 'name' => 'Clubs & Bars' ],
    //         [ 'name' => 'Shopping' ],
    //         [ 'name' => 'Gift & Specialty Shops' ],
    //         [ 'name' => 'Art Galleries' ],
    //         [ 'name' => 'Flea & Street Markets' ],
    //         [ 'name' => 'Fun & Games' ],
    //         [ 'name' => 'Movie Theatres' ],
    //         [ 'name' => 'Playgrounds' ],
    //         [ 'name' => 'Zoos' ]
    //     ];
    //
    //     foreach ($categories as $category) {
    //         Category::create($category);
    //     }
    }
}
