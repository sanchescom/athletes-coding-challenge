<?php

namespace App\Collections;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class AthletesCollection.
 */
class AthletesCollection extends Collection
{
    /** @var string */
    private const COUNTRY_KEY = 'country';

    /** @var string */
    private const PROVINCE_KEY = 'province';

    /** @var string */
    private const CITY_KEY = 'city';

    /**
     * @param callable $closure
     * @return \App\Collections\AthletesCollection
     */
    public function mapCountries(callable $closure): AthletesCollection
    {
        return $this->mapping($closure, self::COUNTRY_KEY);
    }

    /**
     * @param callable $closure
     * @return \App\Collections\AthletesCollection
     */
    public function mapProvinces(callable $closure): AthletesCollection
    {
        return $this->mapping($closure, self::PROVINCE_KEY);
    }

    /**
     * @param callable $closure
     * @return \App\Collections\AthletesCollection
     */
    public function mapCities(callable $closure): AthletesCollection
    {
        return $this->mapping($closure, self::CITY_KEY);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function transformForInsert(): Collection
    {
        return $this->transform(function ($item) {
            return [
                'name' => $item['Name'],
                'age' => $item['Age'],
                'country_id' => $item['country_id'],
                'province_id' => $item['province_id'],
                'city_id' => $item['city_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        });
    }

    /**
     * @param callable $closure
     * @param string $key
     * @return \App\Collections\AthletesCollection
     */
    private function mapping(callable $closure, string $key): AthletesCollection
    {
        $locationKey = 'Location.' . \ucfirst($key);

        $collection = \call_user_func(
            $closure,
            $this->map(fn ($athlete) => data_get($athlete, $locationKey))
        );

        if ($collection->count() > 0) {
            $collection = $collection->keyBy('name');
        }

        return $this->map(function ($item) use ($collection, $locationKey, $key) {
            $item[$key . '_id'] = $collection->get(data_get($item, $locationKey))->getKey();

            return $item;
        });
    }
}
