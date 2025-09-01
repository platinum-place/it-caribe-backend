<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            $path = base_path('csvs/users.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines));

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (empty($row[4])) {
                    continue;
                }

                if ($row[0] == config('app.admin_id')) {
                    User::find(config('app.admin_id'))->update([
                        'password'          => $row[5],
                    ]);
                } else {
                    User::create([
                        'id'                => $row[0],
                        'name'              => $row[1],
                        'email'             => $row[2],
                        'username'          => $row[3],
                        'password'          => $row[5],
                    ]);
                }
            }
        });
    }
}
