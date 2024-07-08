<?php

use App\Transport\Http\Handler\FetchWithdrawalsByRecordCountHandler;
use App\Transport\Http\Handler\FetchWithdrawalsBySingleRecordHandler;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'withdrawals'], function () {
    [
        Route::get('{chipUserId}/byRecordCount/{startDate}/{endDate}', FetchWithdrawalsByRecordCountHandler::class),
        Route::get('{chipUserId}/bySingleRecord/{startDate}/{endDate}', FetchWithdrawalsBySingleRecordHandler::class),
    ];
});
