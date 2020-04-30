<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(RolesTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(CountriesTableSeeder::class);
      $this->call(DistrictsTableSeeder::class);
      $this->call(CitiesTableSeeder::class);
      $this->call(CategoriesTableSeeder::class);
      $this->call(KeywordsTableSeeder::class);
      $this->call(AddressesTableSeeder::class);
      $this->call(DetailsTableSeeder::class);
      $this->call(AttractionsTableSeeder::class);
      $this->call(BusinessHoursTableSeeder::class);
      $this->call(AttractionCategorySeeder::class);
      $this->call(AttractionKeywordTableSeeder::class);
    }
}
