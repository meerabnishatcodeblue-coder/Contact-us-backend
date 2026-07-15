<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request){
        $request->validate([

              'type'=>'required',

              'name'=>'required',

              'email' => 'required|email|unique:contacts,email',

              'phone'=>'nullable',

              'business'=>'nullable',

              'order'=>'nullable',

              'size'=>'nullable',

              'sign_type'=>'nullable',

              'topic'=>'nullable',

              'call_time'=>'nullable',

              'message'=>'required'

        ]);


        $contact = Contact::create([

            'type'=>$request->type,

            'name'=>$request->name,

            'email'=>$request->email,

            'phone'=>$request->phone,

            'business'=>$request->business,

            'order'=>$request->order,

            'size'=>$request->size,

            'sign_type'=>$request->sign_type,

            'topic'=>$request->topic,

            'call_time'=>$request->call_time,

            'message'=>$request->message

        ]);

        $response = Http::withToken(config('services.airtable.token'))
    ->post(
        "https://api.airtable.com/v0/" .
        config('services.airtable.base') . "/" .
        config('services.airtable.table'),
        [
            "fields" => [

                "Type" => $contact->type,
                "Name" => $contact->name,
                "Email" => $contact->email,
                "Phone Number" => $contact->phone,
                "Business" => $contact->business,
                "Order" => $contact->order,
                "Estimated Size" => $contact->size,
                "Sign Type" => $contact->sign_type,
                "Topic" => $contact->topic,
                "Call Time" => $contact->call_time,
                "Message" => $contact->message,

            ]
        ]
    );



         return response()->json([
            'success' => true,
            'message' => 'Contact submitted successfully.',
            'contact' => $contact
        ], 201);






    }
}
