<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use App\Services\FileParser;
use Illuminate\Support\Facades\Storage;

/**
 * Class ParseFile.
 */
class ParseFile
{
    /**
     * Create the event listener.
     *
     * @param \App\Services\FileParser $fileParser
     */
    public function __construct(public FileParser $fileParser)
    {
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\FileUploaded $event
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \JsonException
     */
    public function handle(FileUploaded $event)
    {
        $path = Storage::path($event->file);

        $event->setAthletes(
            $this->fileParser->parse($path)['Players'] ?? []
        );
    }
}
