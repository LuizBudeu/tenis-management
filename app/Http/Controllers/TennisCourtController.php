<?php

namespace App\Http\Controllers;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;
use App\Exceptions\TennisCourtNotFoundException;
use App\Http\Requests\TennisCourt\CreateTennisCourtRequest;
use App\Http\Requests\TennisCourt\UpdateTennisCourtRequest;
use App\Http\Resources\TennisCourtResource;
use App\Models\TennisCourt;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TennisCourtController extends Controller {
    use AuthorizesRequests;

    // Inertia Routes
    public function indexInertia()
    {
        $tennisCourts = TennisCourt::select('court_number', 'court_type', 'status')->get();
        return Inertia::render('TennisCourt/View', [
            'tennisCourts' => $tennisCourts
        ]);
    }

    public function controlInertia()
    {
        $tennisCourts = TennisCourt::select('court_number', 'court_type', 'status')->get();
        return Inertia::render('TennisCourt/Control', [
            'tennisCourts' => $tennisCourts,
            'tennisCourtTypes' => TennisCourtType::toArray(),
            'tennisCourtStatus' => TennisCourtStatus::toArray(),
        ]);
    }

    // API Routes
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TennisCourtResource::collection(TennisCourt::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTennisCourtRequest $request)
    {
        $this->authorize('create', TennisCourt::class);
        $tennisCourt = TennisCourt::create($request->validated());
        return TennisCourtResource::make($tennisCourt);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $tennisCourtNumber)
    {
        try {
            $tennisCourt = TennisCourt::where('court_number', $tennisCourtNumber)->firstOrFail();
            return TennisCourtResource::make($tennisCourt);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new TennisCourtNotFoundException($tennisCourtNumber);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTennisCourtRequest $request, int $tennisCourtNumber)
    {
        try {
            $tennisCourt = TennisCourt::where('court_number', $tennisCourtNumber)->firstOrFail();
            $this->authorize('update', $tennisCourt);
            $tennisCourt->update($request->validated());
            return TennisCourtResource::make($tennisCourt);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new TennisCourtNotFoundException($tennisCourtNumber);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tennisCourtNumber)
    {
        try {
            $tennisCourt = TennisCourt::where('court_number', $tennisCourtNumber)->firstOrFail();
            $this->authorize('delete', $tennisCourt);
            $tennisCourt->delete();
            return response()->json(['message' => 'Tennis court deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw new TennisCourtNotFoundException($tennisCourtNumber);
        }
    }
}
