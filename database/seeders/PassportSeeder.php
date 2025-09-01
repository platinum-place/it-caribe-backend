<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $path = base_path('csvs/oauth_access_tokens.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines)); // Encabezados

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (count($row) < 9) {
                    continue;
                }

                DB::table('oauth_access_tokens')->insert([
                    'id' => $row[0],
                    'user_id' => is_numeric($row[1]) ? (int) $row[1] : null,
                    'client_id' => $row[2],
                    'name' => $row[3],
                    'scopes' => $row[4],
                    'revoked' => filter_var($row[5], FILTER_VALIDATE_BOOLEAN), // true/false
                    'created_at' => $row[6] ? Carbon::parse($row[6]) : now(),
                    'updated_at' => $row[7] ? Carbon::parse($row[7]) : now(),
                    'expires_at' => $row[8] ? Carbon::parse($row[8]) : null,
                ]);
            }

            $path = base_path('csvs/oauth_clients.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines)); // Encabezados

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (count($row) < 11) {
                    continue;
                }

                DB::table('oauth_clients')->insert([
                    'id' => $row[0],
                    'owner_type' => $row[1],
                    'owner_id' => is_numeric($row[2]) ? (int) $row[2] : null,
                    'name' => $row[3],
                    'secret' => $row[4],
                    'provider' => $row[5] ?: null,
                    'grant_types' => $row[7], // Optional: if you're customizing Passport
                    'revoked' => filter_var($row[8], FILTER_VALIDATE_BOOLEAN),
                    'created_at' => $row[9] ? Carbon::parse($row[9]) : now(),
                    'updated_at' => $row[10] ? Carbon::parse($row[10]) : now(),
                    'redirect_uris' => 'not found',
                ]);
            }

            $path = base_path('csvs/personal_access_tokens.csv');
            $csv = File::get($path);
            $lines = explode(PHP_EOL, $csv);
            $headers = str_getcsv(array_shift($lines)); // Encabezados

            foreach ($lines as $line) {
                $row = str_getcsv($line);

                if (count($row) < 10) {
                    continue;
                }

                DB::table('personal_access_tokens')->insert([
                    'id' => $row[0],
                    'tokenable_type' => $row[1],
                    'tokenable_id' => $row[2],
                    'name' => $row[3],
                    'token' => $row[4],
                    'abilities' => $row[5], // Stored as JSON string
                    'last_used_at' => $row[6] ? Carbon::parse($row[6]) : null,
                    'expires_at' => $row[7] ? Carbon::parse($row[7]) : null,
                    'created_at' => $row[8] ? Carbon::parse($row[8]) : now(),
                    'updated_at' => $row[9] ? Carbon::parse($row[9]) : now(),
                ]);
            }
        });

    }
}
