<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\Contact\ContactCollection;
use App\Http\Resources\Contact\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return new ContactResource(Contact::first());
    }

    public function update(ContactRequest $request)
    {
        $contact = Contact::first();
        $contact->update($request->validated());

        return new ContactResource($contact);
    }
}
