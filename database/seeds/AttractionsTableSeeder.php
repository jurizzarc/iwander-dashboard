<?php

use Illuminate\Database\Seeder;
use App\Detail;
use App\Address;
use App\Category;
use App\Keyword;
use App\Attraction;

class AttractionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/attractions.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('attractions table seeded!');

        // $detailsA = Detail::where('id', '1')->first();
        // $detailsB = Detail::where('id', '2')->first();
        // $detailsC = Detail::where('id', '3')->first();
        // $addressA = Address::where('id', '1')->first();
        // $addressB = Address::where('id', '2')->first();
        // $addressC = Address::where('id', '3')->first();
        // $museums_cat = Category::where('name', 'Museums')->first();
        // $histSite_cat = Category::where('name', 'Historical Sites')->first();
        // $histMuseums_cat = Category::where('name', 'History Museums')->first();
        // $bigGroups_kw = Keyword::where('name', 'Good for Big Groups')->first();
        // $budgetFr_kw = Keyword::where('name', 'Budget-friendly')->first();
        // $freeEnt_kw = Keyword::where('name', 'Free Entry')->first();
        //
        // $attractionA = new Attraction();
        // $attractionA->name = 'Kilmainham Gaol Museum';
        // $attractionA->details()->associate($detailsA);
        // $attractionA->addresses()->associate($addressA);
        // $attractionA->rec_duration = '2 hours and 30 minutes';
        // $attractionA->save();
        // $attractionA->categories()->attach($museums_cat);
        // $attractionA->categories()->attach($histSite_cat);
        // $attractionA->keywords()->attach($bigGroups_kw);
        // $attractionA->keywords()->attach($budgetFr_kw);
        //
        // $attractionB = new Attraction();
        // $attractionB->name = 'Guinness Storehouse';
        // $attractionB->details()->associate($detailsB);
        // $attractionB->addresses()->associate($addressB);
        // $attractionB->rec_duration = '2 hours';
        // $attractionB->save();
        // $attractionB->categories()->attach($museums_cat);
        // $attractionB->categories()->attach($histSite_cat);
        // $attractionB->keywords()->attach($bigGroups_kw);
        //
        // $attractionC = new Attraction();
        // $attractionC->name = 'National Museum of Ireland - Decorative Arts & History';
        // $attractionC->details()->associate($detailsC);
        // $attractionC->addresses()->associate($addressC);
        // $attractionC->rec_duration = '1 hour and 30 minutes';
        // $attractionC->save();
        // $attractionC->categories()->attach($museums_cat);
        // $attractionC->categories()->attach($histMuseums_cat);
        // $attractionC->keywords()->attach($freeEnt_kw);
    }
}
