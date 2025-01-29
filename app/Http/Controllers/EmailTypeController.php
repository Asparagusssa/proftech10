<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailTypeRequest;
use App\Http\Resources\Email\EmailTypeCollection;
use App\Http\Resources\Email\EmailTypeResource;
use App\Models\EmailType;
use Illuminate\Http\Request;

class EmailTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmailTypeCollection(EmailType::with([
            'emails' => function ($query) {
                $query->orderBy('id');
            }
        ])->orderBy('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailTypeRequest $request)
    {
        return new EmailTypeResource(EmailType::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show($emailType_id)
    {
        $type = EmailType::firstOrFail($emailType_id);
        return new EmailTypeResource($type->load('emails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailTypeRequest $request, $emailType_id)
    {
        $type = EmailType::findOrFail($emailType_id);
        $type->update($request->validated());
        return new EmailTypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($emailType_id)
    {
        $emailType = EmailType::findOrFail($emailType_id);
        $emailType->delete();
        return response()->noContent();
    }
}
