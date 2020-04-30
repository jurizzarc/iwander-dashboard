<?php

use Illuminate\Database\Seeder;
use App\District;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $path = 'database/migrations/cities.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('City table seeded!');

        // Retrieve County Dublin from districts table
    //     $district_countyDublin = District::where('name', 'County Dublin')->first();
    //     // Retrieve County Galway from the districts table
    //     $district_countyGalway = District::where('name', 'County Galway')->first();
    //
    //     $city1 = new City();
    //     $city1->name = 'Dublin';
    //     $city1->description = "A history spanning over a thousand years, vibrant nightlife, and a mix of
    //     Georgian and modern architecture make Dublin a popular European tourist destination. Founded as a
    //     Viking settlement in the 9th century, this sprawling urban center often surprises visitors with its sheer size.
    //     Nearly 2 million people live in the greater Dublin region, which represents well over a third of Ireland's total
    //     population. The city center, however, remains a relatively compact area, easily explored on foot or by bicycle.
    //     To experience the garrulous locals and their culture in a relaxed and friendly atmosphere, spend some time in a
    //     traditional pub--a staple of Dublin's social life and a favorite stop for the majority of the city's foreign
    //     visitors.";
    //     $city1->districts()->associate($district_countyDublin);
    //     $city1->save();
    //
    //     $city2 = new City();
    //     $city2->name = 'Galway';
    //     $city2->description = "A major hub for visitors exploring Ireland's western regions, Galway serves as a
    //     city of art and culture, renowned for its vibrant lifestyle and numerous festivals. The city's many pubs,
    //     a major draw for bohemian crowds from around the world, offer live music and outdoor seats, ideal for observing
    //     street performers and ordinary natives going about their business. Deeply respectful of its traditions and
    //     rich heritage, Galway is one of the few areas where Irish remains a thriving language in everyday use. Start
    //     your urban adventure by exploring the lively areas along the Corrib River, where you can search for handcrafted
    //     souvenirs and traditional Aran sweaters.";
    //     $city2->districts()->associate($district_countyGalway);
    //     $city2->save();
    }
}
