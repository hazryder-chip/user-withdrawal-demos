<?php

namespace App\Domain\UserWithdrawal;

use Ramsey\Uuid\UuidInterface;

class UserWithdrawal
{
    public function __construct(
        private UuidInterface $id,
        private string $chipUserId,
        private UuidInterface $productId,
        private int $count
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getChipUserId(): string
    {
        return $this->chipUserId;
    }

    public function getProductId(): UuidInterface
    {
        return $this->productId;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
