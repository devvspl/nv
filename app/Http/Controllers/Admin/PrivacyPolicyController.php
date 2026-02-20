<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the form for editing the privacy policy.
     */
    public function edit()
    {
        // always grab the single policy record using helper to satisfy static analysis
        $privacyPolicy = PrivacyPolicy::getActive();
        
        // If no record exists, create a default one
        if (!$privacyPolicy) {
            $privacyPolicy = PrivacyPolicy::create([
                'title' => 'Privacy Policy',
                'content' => '<p>Your privacy policy content goes here.</p>',
                'effective_date' => now(),
                'last_updated' => now()
            ]);
        }
        
        return view('admin.privacy-policy.edit', compact('privacyPolicy'));
    }

    /**
     * Update the privacy policy in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'effective_date' => 'nullable|date',
            'last_updated' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $privacyPolicy = PrivacyPolicy::getActive();
        
        if (!$privacyPolicy) {
            $privacyPolicy = new PrivacyPolicy();
        }

        $privacyPolicy->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'effective_date' => $request->input('effective_date'),
            'last_updated' => $request->input('last_updated') ?? now()
        ]);

        return redirect()->route('admin.privacy-policy.edit')
            ->with('success', 'Privacy Policy updated successfully.');
    }
}
