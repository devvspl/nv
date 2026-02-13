<?php
namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Amenity;
use App\Models\Bhk;
use App\Models\Builder;
use App\Models\Category;
use App\Models\City;
use App\Models\CommercialSection;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\HeroSection;
use App\Models\Location;
use App\Models\ProjectStatus;
use App\Models\Property;
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

    public function properties(Request $request)
    {
        $query = Property::with(['propertyType', 'bhk', 'city', 'location', 'projectStatus', 'builder', 'mainImage'])
            ->active()
            ->published();

        // Apply filters
        if ($request->filled('city_id')) {
            $query->filterByCity($request->city_id);
        }

        if ($request->filled('location_id')) {
            $query->filterByLocation($request->location_id);
        }

        if ($request->filled('property_type_id')) {
            $query->filterByPropertyType($request->property_type_id);
        }

        if ($request->filled('bhk_id')) {
            $query->filterByBhk($request->bhk_id);
        }

        if ($request->filled('project_status_id')) {
            $query->filterByProjectStatus($request->project_status_id);
        }

        if ($request->filled('builder_id')) {
            $query->filterByBuilder($request->builder_id);
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->filterByPriceRange($request->min_price, $request->max_price);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $properties = $query->paginate(12)->withQueryString();

        // Get filter options
        $cities = City::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $propertyTypes = PropertyType::active()->ordered()->get();
        $bhks = \App\Models\Bhk::active()->ordered()->get();
        $projectStatuses = \App\Models\ProjectStatus::active()->ordered()->get();
        $builders = \App\Models\Builder::active()->verified()->ordered()->get();

        return view('properties.index', compact(
            'properties',
            'cities',
            'locations',
            'propertyTypes',
            'bhks',
            'projectStatuses',
            'builders'
        ));
    }

    public function show(Property $property)
    {
        // Increment view count
        $property->incrementViews();

        // Load relationships
        $property->load([
            'propertyType',
            'bhk',
            'city',
            'location',
            'projectStatus',
            'builder',
            'images',
            'amenities',
            'specifications'
        ]);

        // Get similar properties
        $similarProperties = Property::with(['propertyType', 'bhk', 'city', 'mainImage'])
            ->active()
            ->published()
            ->where('id', '!=', $property->id)
            ->where('property_type_id', $property->property_type_id)
            ->where('city_id', $property->city_id)
            ->limit(3)
            ->get();

        return view('properties.show', compact('property', 'similarProperties'));
    }
}
