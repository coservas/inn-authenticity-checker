<?php

namespace App;

class Authenticity
{
    const AUTHENTICITY_INNS = [
        253402065152,
        772739580300
    ];

    const NON_AUTHENTICITY_INNS = [
        784100362403,
        332501373163
    ];

    /**
     * @param string $inn
     *
     * @return array<string, mixed>
     */
    public function get($inn)
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

    /**
     * @param $inn
     *
     * @return bool
     */
    public function isAuthenticity($inn)
    {
        return in_array((int) $inn, self::AUTHENTICITY_INNS, true);
    }

    /**
     * @param $inn
     * @return bool
     */
    public function isNonAuthenticity($inn)
    {
        return in_array((int) $inn, self::NON_AUTHENTICITY_INNS, true);
    }
}
