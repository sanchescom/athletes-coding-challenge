<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class FileUploaded.
 */
class FileUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var array */
    protected array $athletes;

    /**
     * Create a new event instance.
     *
     * @param string $file
     */
    public function __construct(public string $file)
    {
    }

    /**
     * @param array $athletes
     */
    public function setAthletes(array $athletes)
    {
        $this->athletes = $athletes;
    }

    /**
     * @return array
     */
    public function getAthletes(): array
    {
        return $this->athletes;
    }
}
