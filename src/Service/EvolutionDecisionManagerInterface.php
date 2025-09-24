<?php
declare(strict_types=1);


namespace Life\Service;

use Life\Model\Cell;
use Life\Model\EvolutionDecision;

interface EvolutionDecisionManagerInterface
{
    public function getEvolveStrategy(Cell $cell, array $neighbours, int $species): EvolutionDecision;
}