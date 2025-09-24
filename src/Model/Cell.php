<?php
declare(strict_types=1);


namespace Life\Model;

final class Cell
{
    public function __construct(
        public readonly int $x,
        public readonly int $y,
        public ?int $value = null,
    )
    {
    }

    public function die(): void
    {
        $this->value = null;
    }

    public function birth(int $species): void
    {
        $this->value = $species;
    }

    public function isAlive(): bool
    {
        return $this->value !== null;
    }

    public function isEqual(Cell $cell): bool
    {
        return $this->value === $cell->value;
    }

}