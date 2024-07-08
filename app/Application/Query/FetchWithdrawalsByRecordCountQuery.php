<?php

namespace App\Application\Query;

use App\Domain\Withdrawal\WithdrawalRepositoryInterface;
use Carbon\Carbon;

class FetchWithdrawalsByRecordCountQuery
{
    public function __construct(
        private WithdrawalRepositoryInterface $withdrawalRepo
    ) {
    }

    public function execute(string $chipUserId, Carbon $startDate, Carbon $endDate): int
    {
        return $this->withdrawalRepo->getRecordCount($chipUserId, $startDate, $endDate);
    }
}
