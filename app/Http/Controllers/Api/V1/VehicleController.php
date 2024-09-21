<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\VehicleResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class VehicleController extends Controller
{
    public function index()
    {
        return VehicleResource::collection(Vehicle::all());
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());

        return VehicleResource::make($vehicle);
    }

    public function show($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            return VehicleResource::make($vehicle);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(StoreVehicleRequest $request, $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->update($request->validated());

            return response()->json(VehicleResource::make($vehicle), Response::HTTP_ACCEPTED);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Vehicle Not Found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->noContent();
    }
}
