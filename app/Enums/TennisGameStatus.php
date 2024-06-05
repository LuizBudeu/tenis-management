<?php


namespace App\Enums;

enum TennisGameStatus: string
{
    case EmAndamento = 'Em andamento';
    case Finalizado = 'Finalizado';

    public static function toArray(): array
    {
        return array_map(fn($status) => $status->value, self::cases());
    }
}
