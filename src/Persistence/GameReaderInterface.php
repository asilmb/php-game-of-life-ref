<?php
declare(strict_types=1);


namespace Life\Persistence;

use Life\Model\GameState;

interface GameReaderInterface
{

    public function load(): GameState;
}