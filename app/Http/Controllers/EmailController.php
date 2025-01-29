<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Resources\Email\EmailCollection;
use App\Http\Resources\Email\EmailResource;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmailCollection(Email::orderBy('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailRequest $request)
    {
        return new EmailResource(Email::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        return new EmailResource($email);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailRequest $request, Email $email)
    {
        $email->update($request->validated());
        return new EmailResource($email);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        $email->delete();
        return response()->noContent();
    }
}
