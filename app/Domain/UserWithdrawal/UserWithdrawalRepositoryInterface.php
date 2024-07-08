<?php

namespace App\Domain\UserWithdrawal;

use Carbon\Carbon;

interface UserWithdrawalRepositoryInterface
{
    public function getWithdrawalCount(string $chipUserId, Carbon $startDate, Carbon $endDate): int;
}
