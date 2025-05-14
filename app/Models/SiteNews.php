<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static \Illuminate\Database\Eloquent\Builder select(...$columns)
 */
class SiteNews extends Model
{

    public static function getNewsList(): Collection {
        return self::select('news_text', 'date')->orderBy('date', 'desc')->get();
    }
}
