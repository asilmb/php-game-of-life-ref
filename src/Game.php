<?php declare(strict_types = 1);

namespace Life;

use Life\Enum\EvolutionDecisionType;
use Life\Service\EvolutionDecisionManagerInterface;

class Game
{
    public function __construct(
        private readonly StateManager                      $stateManager,
        private readonly EvolutionDecisionManagerInterface $decisionManager,
    )
    {
    }

    public function run(): void
    {
        $gameState = $this->stateManager->load();

        $nextGenerationCells = [];
        for ($i = 0; $i < $gameState->iterationsCount; $i++) {
            for ($y = 0; $y < $gameState->size; $y++) {
                for ($x = 0; $x < $gameState->size; $x++) {
                    $currentCell = $gameState->getCell($x, $y);
                    $cellToEvolve = clone $currentCell;

                    $decision = $this->decisionManager->getEvolveStrategy(
                        $currentCell,
                        $gameState->getNeighbours($x, $y),
                        $gameState->species
                    );

                    switch ($decision->type) {
                        case EvolutionDecisionType::SURVIVE:
                            break;
                        case EvolutionDecisionType::DIE:
                            $cellToEvolve->die();
                            break;
                        case EvolutionDecisionType::POPULATE:
                            $cellToEvolve->birth($decision->species);
                            break;
                    }
                    $nextGenerationCells[$y][$x] = $cellToEvolve;

                }
            }

            $gameState = $gameState->createWithNewCells($nextGenerationCells);
        }

        $this->stateManager->save($gameState);
    }
}
