<?php
declare(strict_types=1);


namespace Life\Persistence;

use Life\Model\GameState;

interface GameWriterInterface
{
    public function save(GameState $gameState): void;
}