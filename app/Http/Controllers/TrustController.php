<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrustRequest;
use App\Http\Resources\Trust\TrustCollection;
use App\Http\Resources\Trust\TrustResource;
use App\Models\Trust;
use Illuminate\Support\Facades\Storage;

class TrustController extends Controller
{
    public function index()
    {
        return new TrustCollection(Trust::orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get());
    }

    public function store(TrustRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('trustImages', 'public');
        return new TrustResource(Trust::create($data));
    }

    public function show(Trust $trust)
    {
        return new TrustResource($trust);
    }

    public function update(TrustRequest $request, $trust_id)
    {
        $data = $request->validated();
        $trust = Trust::findOrFail($trust_id);
        Storage::disk('public')->delete('/trustImages/' . basename($trust->image));
        $data['image'] = $request->file('image')->store('trustImages', 'public');
        $trust->update($data);

        return new TrustResource($trust);
    }

    public function destroy($trust_id)
    {
        $trust = Trust::findOrFail($trust_id);
        Storage::disk('public')->delete('/trustImages/' . basename($trust->image));
        $trust->delete();
        return response()->json();
    }
}
