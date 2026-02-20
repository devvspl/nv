<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsConditionController extends Controller
{
    /**
     * Show edit form for terms and conditions.
     */
    public function edit()
    {
        // fetch the single record using the model helper (avoids calling first() directly)
        $terms = TermsAndCondition::getActive();

        if (! $terms) {
            $terms = TermsAndCondition::create([
                'title' => 'Terms and Conditions',
                'content' => '<p>Your terms and conditions content goes here.</p>',
                'effective_date' => now(),
                'last_updated' => now(),
            ]);
        }

        return view('admin.terms-and-conditions.edit', compact('terms'));
    }

    /**
     * Update the stored terms and conditions.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'effective_date' => 'nullable|date',
            'last_updated' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $terms = TermsAndCondition::getActive();
        if (! $terms) {
            $terms = new TermsAndCondition();
        }

        $terms->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'effective_date' => $request->input('effective_date'),
            'last_updated' => $request->input('last_updated') ?? now(),
        ]);

        return redirect()->route('admin.terms-and-conditions.edit')
            ->with('success', 'Terms and Conditions updated successfully.');
    }
}
