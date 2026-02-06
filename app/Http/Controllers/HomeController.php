<?php
namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Category;
use App\Models\City;
use App\Models\CommercialSection;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();
        $features = Feature::active()->ordered()->get();
        $whyChooseUsFeatures = Feature::active()->byTag('our-services')->ordered()->get();
        $latestPropertiesFeatures = Feature::active()->byTag('why-choose-us')->ordered()->get();
        $aboutUs = AboutUs::getActive();
        $categories = Category::active()->ordered()->get();
        $cities = City::active()->ordered()->get();
        $commercialSection = CommercialSection::getActive();
        
        return view('pages.home', compact(
            'testimonials', 
            'faqs', 
            'features', 
            'whyChooseUsFeatures', 
            'latestPropertiesFeatures', 
            'aboutUs', 
            'categories', 
            'cities',
            'commercialSection'
        ));
    }

    public function search(Request $request)
    {
        return redirect()->route('home')->with('message', 'Search functionality coming soon!');
    }
}
