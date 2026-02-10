<?php
namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\City;
use App\Models\CommercialSection;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HeroSection;
use App\Models\PropertyType;
use App\Models\ServiceType;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroSections = HeroSection::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();
        $features = Feature::active()->ordered()->get();
        $whyChooseUsFeatures = Feature::active()->byTag('our-services')->ordered()->get();
        $latestPropertiesFeatures = Feature::active()->byTag('why-choose-us')->ordered()->get();
        $aboutUs = AboutUs::getActive();
        $categories = Category::active()->ordered()->get();
        $cities = City::active()->ordered()->get();
        $commercialSection = CommercialSection::getActive();
        $serviceTypes = ServiceType::active()->ordered()->with('propertyTypes')->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        
        // Create mapping array for JavaScript
        $serviceTypeMapping = [];
        foreach ($serviceTypes as $serviceType) {
            $serviceTypeMapping[$serviceType->slug] = $serviceType->propertyTypes->pluck('slug')->toArray();
        }
        
        return view('pages.home', compact(
            'heroSections',
            'testimonials', 
            'faqs', 
            'features', 
            'whyChooseUsFeatures', 
            'latestPropertiesFeatures', 
            'aboutUs', 
            'categories', 
            'cities',
            'commercialSection',
            'serviceTypes',
            'propertyTypes',
            'serviceTypeMapping'
        ));
    }

    public function search(Request $request)
    {
        return redirect()->route('home')->with('message', 'Search functionality coming soon!');
    }
}
