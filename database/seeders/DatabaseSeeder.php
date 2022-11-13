<?php
namespace Database\Seeders;

use App\Models\Santa;
use App\Models\User;
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
        User::truncate();
        Santa::truncate();
        User::factory(10)->create();
        $count = User::count();
        $temp = range(1, $count);
        $key = 0;

        for ($i = 0; $i < $count; $i++) {
            if (count($temp) > 1) {
                $index = $temp[$key];
                array_splice($temp, $key, 1);
                $key = array_rand($temp, 1);
                Santa::create([
                    'user_id' => $index,
                    'santa_for' => $temp[$key]
                ]);
            } else {
                Santa::create([
                    'user_id' => $temp[$key],
                    'santa_for' => 1
                ]);
            }
        }
    }
}
