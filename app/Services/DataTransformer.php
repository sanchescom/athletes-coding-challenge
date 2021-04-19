<?php

namespace App\Services;

use App\Collections\AthletesCollection;
use Illuminate\Support\Collection;

/**
 * Class DataTransformer.
 */
class DataTransformer
{
    /** @var Collection */
    protected Collection $collection;

    /**
     * @param array $items
     * @return AthletesCollection
     */
    public function newCollection(array $items): AthletesCollection
    {
        return new AthletesCollection($items);
    }
}
