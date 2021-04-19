<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Models\Athlete;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Services\DataTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

/**
 * Class CreateAthletes.
 */
class CreateAthletes implements ShouldQueue
{
    /** @var int */
    private const CHUNK_SIZE = 1000;

    /**
     * Create the event listener.
     *
     * @param \App\Services\DataTransformer $dataTransformer
     */
    public function __construct(public DataTransformer $dataTransformer)
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
        $this
            ->dataTransformer
            ->newCollection($event->getAthletes())
            ->mapCountries(function (Collection $countries) {
                return Country::findByNames($countries->toArray());
            })
            ->mapProvinces(function (Collection $provinces) {
                return Province::findByNames($provinces->toArray());
            })
            ->mapCities(function (Collection $cities) {
                return City::findByNames($cities->toArray());
            })
            ->transformForInsert()
            ->chunk(self::CHUNK_SIZE)
            ->each(function (Collection $items) {
                Athlete::insert($items->toArray());
            });
    }
}
