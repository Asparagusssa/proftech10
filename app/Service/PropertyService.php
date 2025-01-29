<?php

namespace App\Service;

use App\Http\Requests\PropertyRequest;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyService
{
    public function getAll()
    {
        return Property::orderBy('value')->get();
    }

    public function store(PropertyRequest $request)
    {
        $data = $request->validated();
        return Property::create($data);
    }

    public function update(PropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $property->update($data);
        return $property;
    }

    public function delete(Property $property)
    {
        $property->delete();
        return null;
    }
}
