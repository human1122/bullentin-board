<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PerPageList extends Enum
{
    const PerPage25 = '25';
    const PerPage50 = '50';
    const PerPage75 = '75';
    const PerPage100 = '100';
    
    /**
     * Get the description for an enum value
     *
     * @param  mixed  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::PerPage25:
                return '25';
            case self::PerPage50:
                return '50';
            case self::PerPage75:
                return '75';
            case self::PerPage100:
                return '100';
            default:
                return '';
        }
    }
}
