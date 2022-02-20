<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\contactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactUsController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contact_us = contactUs::get();
        // return $this->apiResponse($contact_us);
        return response()->json($contact_us, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = $this->validation($request);
        if ($validation instanceof Response) {
            return $validation;
        }
        if (is_null($validation)) {
            $contact_us = contactUs::create([
                'email' => $request->email,
                'name' => $request->name,
                'subject' => $request->subject,
                'message' => $request->message,

            ]);
            if ($contact_us) {
                // return $this->createdResponse($contact_us);
                return response()->json($contact_us, 200);
            }
        }
        // $this->unKnowError();
        return response()->json("Cannot send this message", 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact_us = contactUs::find($id);
        if ($contact_us) {
            // return $this->apiResponse($contact_us);
            return response()->json($contact_us, 200);
        }
        // return $this->notFoundResponse();
        return response()->json("Not Found", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $contact_us = contactUs::find($id);
        if ($contact_us) {
            if ($request->isMethod('put')) {
                $validation = $this->validation($request);
                if ($validation instanceof Response) {
                    return $validation;
                }
            }

            $contact_us->update($request->all());
            return response()->json($contact_us, 200);
        }
        return response()->json("Not found", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact_us = contactUs::find($id);
        if (is_null($contact_us)) {
            return response()->json("Record not found", 404);
        }
        $contact_us->delete();
        return response()->json(null, 204);
    }


    public function validation($request)
    {
        return $this->apiValidation($request, [
            'email' => 'required|email',
            'name' => 'required|min:3|max:20',
            'subject' => 'required|min:5|max:20',
            'message' => 'required|min:10|max:100',
        ]);
    }
}
