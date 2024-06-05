<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TennisCourt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tennisGames(): hasMany
    {
        return $this->hasMany(TennisGame::class);
    }
}
