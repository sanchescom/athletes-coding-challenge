<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

/**
 * Trait NameFilterable.
 */
trait NameFilterable
{
    /**
     * Get many countries by names.
     *
     * @param array $names
     * @return Collection
     */
    public static function findByNames(array $names = []): Collection
    {
        return self::query()->whereIn('name', $names)->get();
    }
}
