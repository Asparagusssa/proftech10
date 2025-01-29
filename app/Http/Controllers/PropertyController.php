<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Http\Resources\Product\PropertyCollection;
use App\Http\Resources\Product\PropertyResource;
use App\Models\Property;
use App\Service\PropertyService;

class PropertyController extends Controller
{
    public function __construct(
        protected PropertyService $propertyService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = $this->propertyService->getAll();
        return new PropertyCollection($properties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->propertyService->store($request);
        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property = $this->propertyService->update($request, $property);
        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $this->propertyService->delete($property);
        return response()->json(null, 204);
    }
}
