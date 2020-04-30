<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\District;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $path = 'database/migrations/districts.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('District table seeded!');
        // Retrieve Ireland from countries table
        // $country_ireland = Country::where('name', 'Ireland')->first();
        //
        // $district1 = new District();
        // $district1->name = 'County Dublin';
        // // Associate the Ireland country to this county
        // $district1->country()->associate($country_ireland);
        // $district1->save();
        //
        // $district2 = new District();
        // $district2->name = 'County Galway';
        // // Associate the Ireland country to this county
        // $district2->country()->associate($country_ireland);
        // $district2->save();
    }
}
