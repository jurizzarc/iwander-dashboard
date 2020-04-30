<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\District;
use App\City;
use App\Address;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $path = 'database/migrations/addresses.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('address table seeded!');


      // $ireland = Country::where('name', 'Ireland')->first();
      // $coDublin = District::where('name', 'County Dublin')->first();
      // $dublin = City::where('name', 'Dublin')->first();
      //
      // $addressA = new Address();
      // $addressA->address1 = 'Inchicore Road';
      // $addressA->city()->associate($dublin);
      // $addressA->district()->associate($coDublin);
      // $addressA->postal_code = 'D08 TX25';
      // $addressA->country()->associate($ireland);
      // $addressA->save();
      //
      // $addressB = new Address();
      // $addressB->address1 = 'Ushers';
      // $addressB->city()->associate($dublin);
      // $addressB->district()->associate($coDublin);
      // $addressB->postal_code = 'D08';
      // $addressB->country()->associate($ireland);
      // $addressB->save();
      //
      // $addressC = new Address();
      // $addressC->address1 = '78 Benburb Street';
      // $addressC->city()->associate($dublin);
      // $addressC->district()->associate($coDublin);
      // $addressC->postal_code = 'D07 HW61';
      // $addressC->country()->associate($ireland);
      // $addressC->save();
    }
}
