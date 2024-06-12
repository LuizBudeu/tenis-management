<?php

namespace App\Enums;

enum TennisCourtType: string
{
    case Saibro = 'Saibro';
    case Concreto = 'Concreto';
    case Desconhecido = 'Desconhecido';

    public static function toArray(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }

    public static function getDefaultValue(): string
    {
        return self::Saibro->value;
    }
}
