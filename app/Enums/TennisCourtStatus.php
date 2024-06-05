<?php


namespace App\Enums;

enum TennisCourtStatus: string
{
    case Disponivel = 'Disponivel';
    case Ocupado = 'Ocupado';
    case Reservado = 'Reservado';
    case Indisponivel = 'Indisponivel';
    case Desconhecido = 'Desconhecido';

    public static function toArray(): array
    {
        return array_map(fn($status) => $status->value, self::cases());
    }
}
