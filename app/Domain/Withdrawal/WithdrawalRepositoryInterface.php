<?php

namespace App\Domain\Withdrawal;

use Carbon\Carbon;

interface WithdrawalRepositoryInterface
{
    public function getRecordCount(string $chipUserId, Carbon $startDate, Carbon $endDate): int;
}
