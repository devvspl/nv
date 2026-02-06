<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    /**
     * Store a newly created inquiry in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'property_type' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $inquiry = Inquiry::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'property_type' => $request->property_type,
                'message' => $request->message,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry! We will get back to you soon.',
                'data' => $inquiry
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
