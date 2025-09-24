<?php
declare(strict_types=1);


namespace Life;

use Life\DTO\GameConfig;
use Life\Model\GameState;
use Life\Persistence\IOFabric;

final class StateManager
{
    public function __construct(
        private readonly GameConfig $gameConfig,
        private readonly IOFabric   $IOFabric
    )
    {
    }

    public function load(): GameState
    {
        return $this->IOFabric->getReader($this->gameConfig->inputFile)->load();
    }

    public function save(GameState $gameState): void
    {
        $this->IOFabric->getWriter($this->gameConfig->outputFile)->save($gameState);
    }
}