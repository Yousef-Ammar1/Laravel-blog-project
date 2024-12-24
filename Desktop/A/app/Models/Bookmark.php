<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Mark;

class Bookmark extends Mark
{
    use HasFactory;

    public static function markableRelationName(): string
    {
        return 'bookmarkers';
    }
}
