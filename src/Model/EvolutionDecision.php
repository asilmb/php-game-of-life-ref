<?php
declare(strict_types=1);


namespace Life\Model;

use Life\Enum\EvolutionDecisionType;

final class EvolutionDecision
{
    private function __construct(
        public readonly EvolutionDecisionType $type,
        public readonly ?int $species = null
    ) {}

    public static function survive(): self
    {
        return new self(EvolutionDecisionType::SURVIVE);
    }

    public static function die(): self
    {
        return new self(EvolutionDecisionType::DIE);
    }

    public static function populate(int $species): self
    {
        return new self(EvolutionDecisionType::POPULATE, $species);
    }
}