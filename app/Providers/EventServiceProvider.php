<?php

namespace App\Providers;

use App\Events\FileUploaded;
use App\Listeners\CreateAthletes;
use App\Listeners\DeleteFile;
use App\Listeners\ParseFile;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        FileUploaded::class => [
            ParseFile::class,
            CreateAthletes::class,
            DeleteFile::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
