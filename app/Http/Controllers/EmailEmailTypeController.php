<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailType;
use Illuminate\Http\Request;

class EmailEmailTypeController extends Controller
{
    public function attach($email_id, $email_type_id)
    {
        $email = Email::findOrFail($email_id);
        $email->types()->syncWithoutDetaching($email_type_id);
        return response()->json([
            'message' => 'Email привязан'
        ]);
    }

    public function detach($email_id, $email_type_id)
    {
        $email = Email::findOrFail($email_id);
        $email->types()->detach($email_type_id);
        return response()->json([
            'message' => 'Email отвязан'
        ]);
    }

    public function availableEmails($email_type_id)
    {
        $type = EmailType::findOrFail($email_type_id);
        return Email::whereDoesntHave('types', function ($query) use ($email_type_id) {
            $query->where('email_type_id', $email_type_id);
        })->orderBy('id')->get();
    }
}
