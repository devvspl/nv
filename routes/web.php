<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CommercialSectionController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ConsultationController as AdminConsultationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties/search', [HomeController::class, 'search'])->name('properties.search');

// Public inquiry submission
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

// Public consultation submission
Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::patch('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
        Route::resource('faqs', FaqController::class);
        Route::patch('faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');
        Route::resource('features', FeatureController::class);
        Route::patch('features/{feature}/toggle-status', [FeatureController::class, 'toggleStatus'])->name('features.toggle-status');
        Route::resource('about-us', AboutUsController::class)->parameters(['about-us' => 'aboutUs']);
        Route::patch('about-us/{aboutUs}/toggle-status', [AboutUsController::class, 'toggleStatus'])->name('about-us.toggle-status');
        Route::resource('categories', CategoryController::class);
        Route::patch('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
        Route::resource('cities', CityController::class);
        Route::patch('cities/{city}/toggle-status', [CityController::class, 'toggleStatus'])->name('cities.toggle-status');
        
        // Commercial Sections
        Route::resource('commercial-sections', CommercialSectionController::class);
        Route::patch('commercial-sections/{commercialSection}/toggle-status', [CommercialSectionController::class, 'toggleStatus'])->name('commercial-sections.toggle-status');
        
        // Hero Sections
        Route::resource('hero-sections', HeroSectionController::class);
        Route::patch('hero-sections/{heroSection}/toggle-status', [HeroSectionController::class, 'toggleStatus'])->name('hero-sections.toggle-status');
        
        // Service Types
        Route::resource('service-types', ServiceTypeController::class);
        Route::patch('service-types/{serviceType}/toggle-status', [ServiceTypeController::class, 'toggleStatus'])->name('service-types.toggle-status');
        
        // Property Types
        Route::resource('property-types', PropertyTypeController::class);
        Route::patch('property-types/{propertyType}/toggle-status', [PropertyTypeController::class, 'toggleStatus'])->name('property-types.toggle-status');
        
        // Inquiries management
        Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
        
        // Consultations management
        Route::get('consultations', [AdminConsultationController::class, 'index'])->name('consultations.index');
        Route::get('consultations/{consultation}', [AdminConsultationController::class, 'show'])->name('consultations.show');
        Route::patch('consultations/{consultation}/status', [AdminConsultationController::class, 'updateStatus'])->name('consultations.update-status');
        Route::delete('consultations/{consultation}', [AdminConsultationController::class, 'destroy'])->name('consultations.destroy');
    });
});

require __DIR__.'/auth.php';
