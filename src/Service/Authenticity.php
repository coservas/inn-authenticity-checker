<?php

declare(strict_types=1);

namespace App\Service;

class Authenticity
{
    public const AUTHENTICITY_INNS = [
        '253402065152',
        '772739580300'
    ];

    public const NON_AUTHENTICITY_INNS = [
        '784100362403',
        '332501373163'
    ];

    public function get(string $inn): array
    {
        if ($this->isAuthenticity($inn)) {
            return [
                'inn' => $inn,
                'message' => 'По заданным критериям поиска сведений не найдено.',
                'authenticity' => true,
            ];
        }

        if ($this->isNonAuthenticity($inn)) {
            return [
                'inn' => $inn,
                'message' => 'Наличие признака недостоверности.',
                'authenticity' => false,
            ];
        }

        return [
            'inn' => $inn,
            'message' => 'ИНН не найден.',
            'authenticity' => false,
        ];
    }

    private function isAuthenticity(string $inn): bool
    {
        return in_array($inn, self::AUTHENTICITY_INNS, true);
    }

    private function isNonAuthenticity(string $inn): bool
    {
        return in_array($inn, self::NON_AUTHENTICITY_INNS, true);
    }
}
