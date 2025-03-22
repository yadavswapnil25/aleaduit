<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Values;

enum AuditTypeEnum: string
{
    use InvokableCases, Values;

    case CERTIFIED_AUDITOR = 'Certified Auditor';
    case CA = 'CA';
    case GOVERNMENT_AUDITOR = 'Government Auditor';
}