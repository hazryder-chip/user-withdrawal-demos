<?php

namespace App\Infrastructure\Persistence\Eloquent\Model;

use App\Domain\Withdrawal\Withdrawal as WithdrawalDomain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property string $chipUserId
 * @property UuidInterface $productId
 * @property int $amount
 */
class Withdrawal extends Model
{
    use HasFactory;

    protected $table = 'withdrawals';

    protected $fillable = [
        'id',
        'chipUserId',
        'productId',
        'amount'
    ];
}
