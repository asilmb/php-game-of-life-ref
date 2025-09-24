<?php
declare(strict_types=1);


namespace Life\Service;

use Life\Model\Cell;
use Life\Model\EvolutionDecision;

final class EvolutionDecisionManager implements EvolutionDecisionManagerInterface
{

    public function getEvolveStrategy(Cell $cell, array $neighbours, int $species): EvolutionDecision

    {
        if ($cell->isAlive()) {
            $sameSpeciesCount = 0;
            /** @var Cell $neighbour */
            foreach ($neighbours as $neighbour) {
                if ($neighbour->isEqual($cell)) {
                    $sameSpeciesCount++;
                }
            }

            if ($sameSpeciesCount >= 2 && $sameSpeciesCount <= 3) {
                return EvolutionDecision::survive();
            }
        }


        $speciesForBirth = [];
        for ($i = 0; $i < $species; $i++) {
            $oneSpeciesCount = 0;

            foreach ($neighbours as $neighbour) {
                if ($neighbour->value === $i) {
                    $oneSpeciesCount++;
                }
            }

            if ($oneSpeciesCount === 3) {
                $speciesForBirth[] = $i;
            }
        }

        if (count($speciesForBirth) > 0) {
            return EvolutionDecision::populate($speciesForBirth[array_rand($speciesForBirth)]);
        }
        return EvolutionDecision::die();
    }
}