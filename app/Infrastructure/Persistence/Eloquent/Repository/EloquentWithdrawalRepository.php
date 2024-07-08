<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Domain\Withdrawal\WithdrawalRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Model\Withdrawal;
use Carbon\Carbon;

class EloquentWithdrawalRepository implements WithdrawalRepositoryInterface
{

    public function getRecordCount(string $chipUserId, Carbon $startDate, Carbon $endDate): int
    {
        return Withdrawal::query()
            ->where('chipUserId', '=', $chipUserId)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->count();
    }
}
