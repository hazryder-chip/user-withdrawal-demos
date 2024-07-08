<?php

namespace App\Transport\Http\Handler;

use App\Application\Query\FetchWithdrawalsByRecordCountQuery;
use App\Application\Query\FetchWithdrawalsBySingleRecordQuery;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final readonly class FetchWithdrawalsBySingleRecordHandler
{
    public function __construct(
        private FetchWithdrawalsBySingleRecordQuery $query
    )
    {
    }

    public function __invoke(Request $request, string $chipUserId, string $startDate, string $endDate): JsonResponse
    {
        $startTime = microtime(true);

        $useCache = $request->boolean('useCache');

        if ($useCache) {
            $result = Cache::get('userWithdrawals_' . $chipUserId);

            if (!isset($result)) {
                $result = $this->query->execute(
                    $chipUserId,
                    Carbon::create($startDate),
                    Carbon::create($endDate)
                );

                Cache::put('userWithdrawals_' . $chipUserId, $result);
            }
        } else {
            $result = $this->query->execute(
                $chipUserId,
                Carbon::create($startDate),
                Carbon::create($endDate)
            );
        }

        $executionTime = round((microtime(true) - $startTime) * 1000);

        return new JsonResponse([
            'count' => $result,
            'executionTimeMs' => $executionTime,
            'cached' => $useCache
        ]);
    }
}
