<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class FileParser.
 */
class FileParser
{
    /**
     * @param string $path
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \JsonException
     */
    public function parse(string $path): array
    {
        if (!\is_file($path)) {
            throw new FileNotFoundException("File {$path} not found");
        }

        $json = \json_decode(\file_get_contents($path), true);

        if (!\json_last_error() == JSON_ERROR_NONE) {
            throw new \JsonException("Invalid json");
        }

        return $json;
    }
}
