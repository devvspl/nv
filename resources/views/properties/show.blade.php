@extends('layouts.app')

@section('title', $property->title . ' - ZendoIndia')

@section('styles')
<style>
/* Property Detail Styles */
.property-detail-section {
    padding: 140px 0 60px;
    background: #fbf8f2;
}

.property-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
}

.property-header {
    background: white;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 10px 30px rgba(11,44,61,0.08);
}

.property-title {
    font-size: 36px;
    font-weight: 900;
    color: #0b2c3d;
    margin: 0 0 12px;
}

.property-location {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(11,44,61,0.70);
    font-size: 16px;
    margin-bottom: 16px;
}

.property-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.property-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    background: rgba(179,147,89,0.12);
    color: #0b2c3d;
    border: 1px solid rgba(179,147,89,0.25);
}

.property-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
    margin-bottom: 40px;
}

.property-main {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.property-card {
    background: white;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(11,44,61,0.08);
}

.card-title {
    font-size: 24px;
    font-weight: 800;
    color: #0b2c3d;
    margin: 0 0 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid rgba(179,147,89,0.2);
}

.property-gallery {
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 24px;
}

.main-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.thumbnail-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 12px;
}

.thumbnail {
    height: 100px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.2s;
}

.thumbnail:hover {
    border-color: #b39359;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.property-description {
    color: rgba(11,44,61,0.80);
    line-height: 1.8;
    font-size: 16px;
}

.specs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: rgba(179,147,89,0.06);
    border-radius: 12px;
}

.spec-icon {
    width: 40px;
    height: 40px;
    background: #b39359;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.spec-content {
    flex: 1;
}

.spec-label {
    font-size: 12px;
    color: rgba(11,44,61,0.60);
    font-weight: 600;
    margin-bottom: 4px;
}

.spec-value {
    font-size: 16px;
    font-weight: 800;
    color: #0b2c3d;
}

.amenities-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.amenity-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: rgba(179,147,89,0.06);
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
}

.amenity-icon {
    width: 24px;
    height: 24px;
    color: #b39359;
}

/* Sidebar */
.property-sidebar {
    position: sticky;
    top: 120px;
}

.price-card {
    background: linear-gradient(135deg, #0b2c3d 0%, #1a4a5f 100%);
    color: white;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 20px 40px rgba(11,44,61,0.20);
}

.price-label {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 8px;
}

.price-value {
    font-size: 42px;
    font-weight: 900;
    color: #b39359;
    margin-bottom: 24px;
}

.contact-btn {
    width: 100%;
    padding: 16px;
    background: #b39359;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 12px;
}

.contact-btn:hover {
    background: #9a7c4d;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(179,147,89,0.3);
}

.contact-btn.secondary {
    background: white;
    color: #0b2c3d;
    border: 2px solid rgba(255,255,255,0.2);
}

.contact-btn.secondary:hover {
    background: rgba(255,255,255,0.1);
    color: white;
}

.builder-card {
    background: white;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(11,44,61,0.08);
}

.builder-info {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
}

.builder-logo {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: rgba(179,147,89,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 900;
    color: #b39359;
}

.builder-name {
    font-size: 18px;
    font-weight: 800;
    color: #0b2c3d;
    margin-bottom: 4px;
}

.builder-verified {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: #10b981;
    font-weight: 600;
}

/* Similar Properties */
.similar-section {
    padding: 60px 0;
    background: white;
}

.section-title {
    font-size: 32px;
    font-weight: 900;
    color: #0b2c3d;
    margin-bottom: 32px;
    text-align: center;
}

.similar-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.similar-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(11,44,61,0.10);
    box-shadow: 0 10px 30px rgba(11,44,61,0.08);
    transition: all 0.3s;
}

.similar-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(11,44,61,0.14);
}

.similar-image {
    height: 200px;
    background-size: cover;
    background-position: center;
}

.similar-body {
    padding: 20px;
}

.similar-title {
    font-size: 18px;
    font-weight: 800;
    color: #0b2c3d;
    margin-bottom: 8px;
}

.similar-meta {
    font-size: 14px;
    color: rgba(11,44,61,0.70);
    margin-bottom: 12px;
}

.similar-price {
    font-size: 22px;
    font-weight: 900;
    color: #b39359;
    margin-bottom: 12px;
}

.similar-btn {
    width: 100%;
    padding: 12px;
    background: transparent;
    color: #b39359;
    border: 2px solid #b39359;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    display: block;
    text-align: center;
    transition: all 0.2s;
}

.similar-btn:hover {
    background: #b39359;
    color: white;
}

@media (max-width: 1024px) {
    .property-grid {
        grid-template-columns: 1fr;
    }
    
    .property-sidebar {
        position: relative;
        top: 0;
    }
    
    .similar-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .property-title {
        font-size: 28px;
    }
    
    .specs-grid {
        grid-template-columns: 1fr;
    }
    
    .amenities-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .similar-grid {
        grid-template-columns: 1fr;
    }
    
    .main-image {
        height: 300px;
    }
}
</style>
@endsection

@section('content')
<section class="property-detail-section">
    <div class="property-container">
        <!-- Property Header -->
        <div class="property-header">
            <h1 class="property-title">{{ $property->title }}</h1>
            <div class="property-location">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none">
                    <path d="M12 21s7-5.2 7-11A7 7 0 1 0 5 10c0 5.8 7 11 7 11z" stroke="#b39359" stroke-width="1.7"/>
                    <circle cx="12" cy="10" r="2.3" stroke="#b39359" stroke-width="1.7"/>
                </svg>
                {{ $property->address }}, {{ $property->location->name ?? '' }}, {{ $property->city->name ?? '' }}
            </div>
            <div class="property-badges">
                @if($property->is_featured)
                    <span class="property-badge">Featured</span>
                @endif
                @if($property->is_verified)
                    <span class="property-badge">Verified</span>
                @endif
                @if($property->projectStatus)
                    <span class="property-badge">{{ $property->projectStatus->name }}</span>
                @endif
                <span class="property-badge">{{ $property->propertyType->name ?? '' }}</span>
                <span class="property-badge">{{ $property->bhk->name ?? '' }}</span>
            </div>
        </div>

        <!-- Property Grid -->
        <div class="property-grid">
            <!-- Main Content -->
            <div class="property-main">
                <!-- Gallery -->
                @if($property->images->count() > 0)
                    <div class="property-gallery">
                        <img src="{{ $property->images->first()->image_path }}" alt="{{ $property->title }}" class="main-image" id="mainImage">
                        @if($property->images->count() > 1)
                            <div class="thumbnail-grid">
                                @foreach($property->images->take(4) as $image)
                                    <div class="thumbnail" onclick="document.getElementById('mainImage').src='{{ $image->image_path }}'">
                                        <img src="{{ $image->image_path }}" alt="{{ $property->title }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Description -->
                <div class="property-card">
                    <h2 class="card-title">About This Property</h2>
                    <div class="property-description">
                        {{ $property->description }}
                    </div>
                </div>

                <!-- Specifications -->
                <div class="property-card">
                    <h2 class="card-title">Property Specifications</h2>
                    <div class="specs-grid">
                        @if($property->carpet_area)
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor">
                                        <rect x="3" y="3" width="18" height="18" stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Carpet Area</div>
                                    <div class="spec-value">{{ number_format($property->carpet_area) }} sq.ft</div>
                                </div>
                            </div>
                        @endif

                        @if($property->built_up_area)
                            <div class="spec-item">
                                <div class="spec-icon">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="spec-content">
                                    <div class="spec-label">Built-up Area</div>
                                    <div class="spec-value">{{ number_format($property->built_up_area) }} sq.ft</div>
                                </div>
                            </div>
                        @endif

                        @if($property->price_per_sqft)
                            <div class="spec-item">
                                <div class="spec-icon">₹</div>
                                <div class="spec-content">
                                    <div class="spec-label">Price per sq.ft</div>
                                    <div class="spec-value">₹{{ number_format($property->price_per_sqft) }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="spec-item">
                            <div class="spec-icon">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2"/>
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Views</div>
                                <div class="spec-value">{{ number_format($property->views_count) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                @if($property->amenities->count() > 0)
                    <div class="property-card">
                        <h2 class="card-title">Amenities</h2>
                        <div class="amenities-grid">
                            @foreach($property->amenities as $amenity)
                                <div class="amenity-item">
                                    <svg class="amenity-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ $amenity->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="property-sidebar">
                <!-- Price Card -->
                <div class="price-card">
                    <div class="price-label">Starting Price</div>
                    <div class="price-value">{{ $property->formatted_price }}</div>
                    <button class="contact-btn">Contact Now</button>
                    <button class="contact-btn secondary">Schedule Visit</button>
                </div>

                <!-- Builder Card -->
                @if($property->builder)
                    <div class="builder-card">
                        <h3 class="card-title">Builder</h3>
                        <div class="builder-info">
                            <div class="builder-logo">
                                {{ substr($property->builder->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="builder-name">{{ $property->builder->name }}</div>
                                @if($property->builder->is_verified)
                                    <div class="builder-verified">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Verified Builder
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($property->builder->description)
                            <p style="font-size: 14px; color: rgba(11,44,61,0.70); line-height: 1.6;">
                                {{ Str::limit($property->builder->description, 150) }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Similar Properties -->
@if($similarProperties->count() > 0)
    <section class="similar-section">
        <div class="property-container">
            <h2 class="section-title">Similar Properties</h2>
            <div class="similar-grid">
                @foreach($similarProperties as $similar)
                    <div class="similar-card">
                        <div class="similar-image" style="background-image:url('{{ $similar->main_image_url ?? 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=70' }}');"></div>
                        <div class="similar-body">
                            <h3 class="similar-title">{{ $similar->title }}</h3>
                            <p class="similar-meta">{{ $similar->city->name ?? '' }} • {{ $similar->bhk->name ?? '' }}</p>
                            <div class="similar-price">{{ $similar->formatted_price }}</div>
                            <a href="{{ route('properties.show', $similar->slug) }}" class="similar-btn">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
