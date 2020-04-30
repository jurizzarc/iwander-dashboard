<?php

use Illuminate\Database\Seeder;
use App\Attraction;
use App\BusinessHours;

class BusinessHoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = 'database/migrations/business_hours.sql';
      DB::unprepared(file_get_contents($path));
      $this->command->info('business hours table seeded!');
    //     $kilmhainham = Attraction::where('id', '1')->value('id');
    //     $guinness = Attraction::where('id', '2')->value('id');
    //     $natMuseum = Attraction::where('id', '3')->value('id');
    //
    //     $sun = 1;
    //     $mon = 2;
    //     $tue = 3;
    //     $wed = 4;
    //     $thu = 5;
    //     $fri = 6;
    //     $sat = 7;
    //
    //     DB::table('business_hours')->delete();
    //
    //     $businessHours = [
    //         [ 'attraction_id' => $kilmhainham, 'day' => $sun, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $mon, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $tue, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $wed, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $thu, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $fri, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $kilmhainham, 'day' => $sat, 'open_time' => '9:30:00', 'close_time' => '18:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $sun, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $mon, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $tue, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $wed, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $thu, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $fri, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $guinness, 'day' => $sat, 'open_time' => '9:30:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $sun, 'open_time' => '1:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $mon, 'open_time' => '1:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $tue, 'open_time' => '10:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $wed, 'open_time' => '10:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $thu, 'open_time' => '10:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $fri, 'open_time' => '10:00:00', 'close_time' => '17:00:00' ],
    //         [ 'attraction_id' => $natMuseum, 'day' => $sat, 'open_time' => '10:00:00', 'close_time' => '17:00:00' ],
    //     ];
    //
    //     foreach ($businessHours as $businessHour) {
    //         BusinessHours::create($businessHour);
    //     }
    }
}
