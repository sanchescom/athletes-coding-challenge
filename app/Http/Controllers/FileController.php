<?php

namespace App\Http\Controllers;

use App\Events\FileUploaded;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class FileController.
 */
class FileController extends Controller
{
    /**
     * Store a newly uploaded resource in storage.
     *
     * @param \App\Http\Requests\StoreFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFileRequest $request): JsonResponse
    {
        FileUploaded::dispatch($request->file->store('uploads'));

        return \response()->json(['data' => 'You have successfully uploaded the file.']);
    }
}
