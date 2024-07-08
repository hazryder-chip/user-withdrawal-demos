<?php

namespace App\Infrastructure\Persistence\Eloquent\Model;

use App\Domain\UserWithdrawal\UserWithdrawal as UserWithdrawalDomain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

/**
 * @property UuidInterface $id
 * @property string $chipUserId
 * @property UuidInterface $productId
 * @property int $count
 */
class UserWithdrawal extends Model
{
    use HasFactory;

    protected $table = 'user_withdrawals';

    protected $fillable = [
        'id',
        'chipUserId',
        'productId',
        'count'
    ];
}
