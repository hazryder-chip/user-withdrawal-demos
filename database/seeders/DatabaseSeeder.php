<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use SplFixedArray;

class DatabaseSeeder extends Seeder
{
    const USERS = 250000;
    const YEARS = 3;
    const WITHDRAWALS_MIN = 1;
    const WITHDRAWALS_MAX = 20;
    const LAS_PRODUCT_ID = 'd1b3b3b3-7b3b-4b3b-8b3b-3b3b3b3b3b3b';

    private $userIds;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::connection()->disableQueryLog();    // Disabling this to speed up runtime

        echo('Generating user ids' . PHP_EOL);

        $this->userIds = new SplFixedArray(self::USERS); // SplFixedArray consumes less memory than a standard array
        for ($i = 0; $i < self::USERS; $i++) {
            $this->userIds[$i] = str()->random(24);
        }

        $this->seedWithdrawals();
        $this->seedUserWithdrawals();
    }

    private function seedWithdrawals(): void
    {
        for ($year = 0; $year < self::YEARS; $year++) {
            echo('Generating withdrawal data for year ' . $year + 1 . PHP_EOL);

            // Chunk data generation to avoid memory issues
            for ($userChunk = 0; $userChunk <= self::USERS; $userChunk += 50000) {
                $data = [];

                for ($user = $userChunk; $user < ($userChunk + 50000) && $user < self::USERS; $user++) {
                    $withdrawals = rand(self::WITHDRAWALS_MIN, self::WITHDRAWALS_MAX);

                    for ($withdrawal = 0; $withdrawal < $withdrawals; $withdrawal++) {
                        $data[] = [
                            'id' => Uuid::uuid4()->toString(),
                            'chipUserId' => $this->userIds[$user],
                            'productId' => self::LAS_PRODUCT_ID,
                            'amount' => rand(100, 10000),
                            'created_at' => Carbon::now()->startOfYear()->addYears($year),
                            'updated_at' => Carbon::now()->startOfYear()->addYears($year),
                        ];
                    }
                }

                if (count($data) > 0) {
                    echo('Inserting ' . count($data) . ' withdrawals' . PHP_EOL);

                    $this->chunkInsert('withdrawals', $data);
                }
            }
        }
    }

    private function seedUserWithdrawals(): void
    {
        for ($year = 0; $year < self::YEARS; $year++) {
            echo('Generating user withdrawal data for year ' . $year + 1 . PHP_EOL);
            $data = [];

            for ($user = 0; $user < self::USERS; $user++) {
                $withdrawals = rand(self::WITHDRAWALS_MIN, self::WITHDRAWALS_MAX);

                $data[] = [
                    'id' => Uuid::uuid4()->toString(),
                    'chipUserId' => $this->userIds[$user],
                    'productId' => self::LAS_PRODUCT_ID,
                    'count' => $withdrawals,
                    'created_at' => Carbon::now()->startOfYear()->addYears($year),
                    'updated_at' => Carbon::now()->startOfYear()->addYears($year),
                ];
            }

            if (count($data) > 0) {
                echo('Inserting ' . count($data) . ' user withdrawals' . PHP_EOL);

                $this->chunkInsert('user_withdrawals', $data);
            }
        }
    }

    private function chunkInsert(string $table, array $data, int $chunkSize = 10000): void
    {
        $chunks = collect($data)->chunk($chunkSize);

        $chunks->each(function ($chunk, $key) use ($table, $chunks) {
            DB::table($table)->insert($chunk->toArray());

            echo('Inserted chunk ' . $key . ' of ' . $chunks->count() . PHP_EOL);
        });
    }
}
