<?php
declare(strict_types=1);


namespace Life\Enum;

enum EvolutionDecisionType: string
{
    case SURVIVE = 'survive';
    case DIE = 'die';
    case POPULATE = 'populate';
}