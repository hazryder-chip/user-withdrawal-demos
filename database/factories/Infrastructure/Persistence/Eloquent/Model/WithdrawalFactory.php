<?php

namespace Database\Factories\Infrastructure\Persistence\Eloquent\Model;

use App\Infrastructure\Persistence\Eloquent\Model\Withdrawal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class WithdrawalFactory extends Factory
{
    protected $model = Withdrawal::class;

    public function definition()
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'chipUserId' => str()->random(24),
            'productId' => Uuid::uuid4()->toString(),
            'amount' => rand(100, 10000),
        ];
    }
}
