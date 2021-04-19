<?php

namespace App\Http\Controllers;

use App\Http\Resources\AthleteResource;
use App\Http\Resources\AthletesResource;
use App\Models\Athlete;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class AthleteController.
 */
class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AthletesResource::collection(Athlete::all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Athlete $athlete
     * @return \App\Http\Resources\AthleteResource
     */
    public function show(Athlete $athlete): AthleteResource
    {
        return new AthleteResource($athlete);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Athlete $athlete
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Athlete $athlete): JsonResponse
    {
        $athlete->delete();

        return \response()->json(['data' => 'The athlete successfully deleted']);
    }
}
