<?php

namespace App\Domain\Withdrawal;

use Ramsey\Uuid\UuidInterface;

class Withdrawal
{
    public function __construct(
        private UuidInterface $id,
        private string $chipUserId,
        private UuidInterface $productId,
        private int $amount
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

    public function getAmount(): int
    {
        return $this->amount;
    }
}
