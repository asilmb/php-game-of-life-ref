<?php
declare(strict_types=1);


namespace Life\DTO;

final class GameConfig
{
    public function __construct(
        public readonly string $inputFile,
        public readonly string $outputFile,
    )
    {
    }
}