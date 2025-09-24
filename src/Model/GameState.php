<?php
declare(strict_types=1);


namespace Life\Model;

final class GameState
{
    /**
     * @param int $size
     * @param int $species
     * @param array<Cell> $cells
     * @param int $iterationsCount
     */
    private function __construct(
        public readonly int    $size,
        public readonly int    $species,
        private readonly array $cells,
        public readonly int    $iterationsCount,
    )
    {
    }

    public function getCell(int $x, int $y): Cell
    {
        return $this->cells[$y][$x];
    }

    public function getNeighbours(int $x, int $y): array
    {
        $neighbours = [];

        for ($dy = -1; $dy <= 1; $dy++) {
            for ($dx = -1; $dx <= 1; $dx++) {
                if ($dx === 0 && $dy === 0) {
                    continue;
                }
                $nx = $x + $dx;
                $ny = $y + $dy;
                if ($nx >= 0 && $ny >= 0 && $nx < $this->size && $ny < $this->size) {
                    $neighbours[] = $this->getCell($nx, $ny);
                }
            }
        }
        return $neighbours;
    }

    /**
     * @param array<Cell> $nextGenerationCells
     */
    public function createWithNewCells(array $nextGenerationCells): self
    {
        return new self($this->size, $this->species, $nextGenerationCells, $this->iterationsCount);
    }

    public static function create(int $size, int $species, array $cells, int $iterationCount): self
    {
        return new self($size, $species, $cells, $iterationCount);
    }
}