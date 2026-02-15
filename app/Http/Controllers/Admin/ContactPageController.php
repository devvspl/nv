<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    public function edit()
    {
        $sections = ContactPageSection::all()->keyBy('section_key');
        
        // Create default sections if they don't exist
        $defaultSections = ['banner', 'contact_section', 'inquiry_section'];
        foreach ($defaultSections as $key) {
            if (!isset($sections[$key])) {
                $sections[$key] = ContactPageSection::create([
                    'section_key' => $key,
                    'heading' => '',
                    'subheading' => '',
                    'description' => '',
                    'is_active' => true,
                ]);
            }
        }

        return view('admin.contact-page.edit', compact('sections'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'contact_subheading' => 'required|string|max:255',
            'contact_heading' => 'required|string|max:255',
            'inquiry_subheading' => 'required|string|max:255',
            'inquiry_heading' => 'required|string|max:255',
            'inquiry_description' => 'nullable|string',
        ]);

        // Update Banner Section
        $banner = ContactPageSection::firstOrCreate(['section_key' => 'banner']);
        $banner->heading = $validated['banner_heading'];
        
        if ($request->hasFile('banner_image')) {
            if ($banner->banner_image) {
                Storage::disk('public')->delete($banner->banner_image);
            }
            $banner->banner_image = $request->file('banner_image')->store('contact-banners', 'public');
        }
        $banner->save();

        // Update Contact Section
        $contactSection = ContactPageSection::firstOrCreate(['section_key' => 'contact_section']);
        $contactSection->subheading = $validated['contact_subheading'];
        $contactSection->heading = $validated['contact_heading'];
        $contactSection->save();

        // Update Inquiry Section
        $inquirySection = ContactPageSection::firstOrCreate(['section_key' => 'inquiry_section']);
        $inquirySection->subheading = $validated['inquiry_subheading'];
        $inquirySection->heading = $validated['inquiry_heading'];
        $inquirySection->description = $validated['inquiry_description'];
        $inquirySection->save();

        return redirect()->route('admin.contact-page.edit')
            ->with('success', 'Contact page updated successfully.');
    }
}
