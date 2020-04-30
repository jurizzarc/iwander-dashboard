<?php

use Illuminate\Database\Seeder;
use App\Detail;

class DetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/details.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('details table seeded!');
      // $detailsA = new Detail();
      // $detailsA->description = "Kilmainham Gaol Museum turns the clock back a few decades, offering you a look
      // inside one of history's most notorious prisons. The imposing gray building played a key role in Irish history
      // for over a century, finally closing its doors in 1924. Before then it provided a grim setting for the imprisonment
      // of notable participants in the many uprisings for Irish independence, culminating in the execution of 14 men who
      // led a rebellion that took place during Easter week in 1916. You can take a guided walk through the history of this
      // eerie site, now one of Europe's largest unoccupied structures of its kind. Before you leave, look in on the yard
      // where the infamous 1916 executions took place.";
      // $detailsA->website = 'http://kilmainhamgaolmuseum.ie/';
      // $detailsA->email = 'kilmainhamgaol@opw.ie';
      // $detailsA->phone = '+353 1 4535984';
      // $detailsA->min_price = '4.00';
      // $detailsA->max_price = '8.00';
      // $detailsA->save();
      //
      // $detailsB = new Detail();
      // $detailsB->description = "Have a pint of Ireland's favorite beer at Guinness Storehouse, which
      // narrates the history of one of the country's major exports. The old storehouse is the only part of a
      // massive brewery open to the public--its signature attraction is a glass atrium designed to resemble a
      // pint of Guinness. Discover the history of both the historical brewery and the popular brand on the ground
      // floor, and then proceed up through seven more floors that demonstrate everything from the selection of barley
      // and hops to the transportation and advertising of the finished product. Once you reach the top, claim your
      // complimentary pint of the black brew at the storehouse's glass-enclosed bar, which offers panoramic views
      // of the city.";
      // $detailsB->website = 'https://www.guinness-storehouse.com/en';
      // $detailsB->phone = '+353 1 408 4800';
      // $detailsB->min_price = '5.00';
      // $detailsB->max_price = '25.00';
      // $detailsB->save();
      //
      // $detailsC = new Detail();
      // $detailsC->description = "National Museum of Ireland - Decorative Arts & History houses a wealth of important
      // artifacts, including weaponry, furniture, costumes, and crafts. This museum serves as a branch of the National
      // Museum of Ireland and was founded in 1997. In the main exhibits, admire arts, crafts, and wares, including a
      // collection of Irish coins and currency. You can also see Etruscan vases, King William's gauntlets from the
      // Battle of the Boyne, and a pocketbook of famous Irish revolutionary figure Wolfe Tone, among many other
      // cherished pieces. Explore the cultural history of Ireland through beloved works of art that once served
      // functional purposes. All galleries are wheelchair accessible. Closed Mondays (including Bank Holidays, Good
      // Friday, and Christmas Day).";
      // $detailsC->website = 'https://www.museum.ie/Decorative-Arts-History';
      // $detailsC->email = 'marketing@museum.ie';
      // $detailsC->phone = '+353 1 6777444';
      // $detailsC->save();
    }
}
