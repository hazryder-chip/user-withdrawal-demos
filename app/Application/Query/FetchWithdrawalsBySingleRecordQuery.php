<?php

namespace App\Application\Query;

use App\Domain\UserWithdrawal\UserWithdrawalRepositoryInterface;
use Carbon\Carbon;

class FetchWithdrawalsBySingleRecordQuery
{
    public function __construct(
        private UserWithdrawalRepositoryInterface $withdrawalRepo
    ) {
    }

    public function execute(string $chipUserId, Carbon $startDate, Carbon $endDate): int
    {
        return $this->withdrawalRepo->getWithdrawalCount($chipUserId, $startDate, $endDate);
    }
}
