<?php

namespace App\Infrastructure\Persistence\Eloquent\Repository;

use App\Domain\UserWithdrawal\UserWithdrawalRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Model\UserWithdrawal;
use Carbon\Carbon;

class EloquentUserWithdrawalRepository implements UserWithdrawalRepositoryInterface
{

    public function getWithdrawalCount(string $chipUserId, Carbon $startDate, Carbon $endDate): int
    {
        /** @var UserWithdrawal $result */
        $result =  UserWithdrawal::query()
            ->where('chipUserId', '=', $chipUserId)
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->firstOrFail();

        return (int)$result->getAttribute('count');
    }
}
