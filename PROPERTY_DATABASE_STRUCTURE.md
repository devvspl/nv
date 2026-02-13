# Property Listing Database Structure

## Overview
This document describes the complete database structure for the residential property listing website.

## Database Tables

### 1. **builders**
Stores information about property builders/developers.

**Columns:**
- `id` - Primary key
- `name` - Builder name
- `slug` - URL-friendly slug
- `logo` - Logo image path
- `description` - Builder description
- `website` - Website URL
- `email` - Contact email
- `phone` - Contact phone
- `address` - Office address
- `established_year` - Year of establishment
- `is_verified` - Verification status
- `status` - Active/Inactive
- `display_order` - Display order
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- `status`, `is_verified`, `name`

---

### 2. **properties**
Main table storing all property listings.

**Columns:**
- `id` - Primary key
- `title` - Property title
- `slug` - URL-friendly slug
- `description` - Property description
- `property_type_id` - FK to property_types
- `bhk_id` - FK to bhks
- `city_id` - FK to cities
- `location_id` - FK to locations
- `project_status_id` - FK to project_statuses
- `builder_id` - FK to builders (nullable)
- `price` - Property price (decimal 15,2)
- `price_per_sqft` - Price per square foot
- `carpet_area` - Carpet area in sq ft
- `built_up_area` - Built-up area in sq ft
- `plot_area` - Plot area in sq ft
- `address` - Full address
- `latitude`, `longitude` - GPS coordinates
- `is_featured` - Featured listing flag
- `is_verified` - Verified listing flag
- `is_active` - Active/Inactive status
- `views_count` - Total views counter
- `user_id` - FK to users (property owner/agent)
- `published_at` - Publication timestamp
- `created_at`, `updated_at`, `deleted_at` - Timestamps

**Indexes:**
- Individual: `property_type_id`, `bhk_id`, `city_id`, `location_id`, `project_status_id`, `builder_id`, `price`, `is_featured`, `is_verified`, `is_active`, `published_at`
- Composite: `idx_search` (city_id, property_type_id, bhk_id, price)
- Fulltext: `idx_fulltext` (title, description)

---

### 3. **amenities**
Master list of all available amenities.

**Columns:**
- `id` - Primary key
- `name` - Amenity name
- `slug` - URL-friendly slug
- `icon` - Icon (emoji or class name)
- `category` - ENUM: basic, security, recreation, convenience, eco_friendly
- `status` - Active/Inactive
- `display_order` - Display order
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- `status`, `category`

---

### 4. **property_amenities**
Pivot table linking properties to amenities (Many-to-Many).

**Columns:**
- `id` - Primary key
- `property_id` - FK to properties
- `amenity_id` - FK to amenities
- `created_at` - Timestamp

**Indexes:**
- Unique: `(property_id, amenity_id)`
- Individual: `property_id`, `amenity_id`

---

### 5. **property_images**
Stores multiple images for each property.

**Columns:**
- `id` - Primary key
- `property_id` - FK to properties
- `image_path` - Image file path
- `image_type` - ENUM: main, gallery, floor_plan, location_map
- `title` - Image title/caption
- `display_order` - Display order
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- `property_id`, `image_type`, `display_order`

---

### 6. **property_specifications**
Additional property specifications (One-to-One with properties).

**Columns:**
- `id` - Primary key
- `property_id` - FK to properties (unique)
- `total_floors` - Total floors in building
- `floor_number` - Property floor number
- `bedrooms` - Number of bedrooms
- `bathrooms` - Number of bathrooms
- `balconies` - Number of balconies
- `parking_spaces` - Number of parking spaces
- `furnishing_status` - ENUM: unfurnished, semi_furnished, fully_furnished
- `facing` - ENUM: north, south, east, west, north_east, north_west, south_east, south_west
- `age_of_property` - Age in years
- `possession_date` - Possession date
- `rera_id` - RERA registration ID
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- `furnishing_status`, `facing`

---

### 7. **property_inquiries**
Stores property inquiry/lead information.

**Columns:**
- `id` - Primary key
- `property_id` - FK to properties
- `name` - Inquirer name
- `email` - Inquirer email
- `phone` - Inquirer phone
- `message` - Inquiry message
- `inquiry_type` - ENUM: site_visit, call_back, email_info, general
- `status` - ENUM: pending, contacted, interested, not_interested, closed
- `ip_address` - IP address
- `created_at`, `updated_at` - Timestamps

**Indexes:**
- `property_id`, `status`, `created_at`

---

### 8. **property_views**
Tracks property page views.

**Columns:**
- `id` - Primary key
- `property_id` - FK to properties
- `user_id` - FK to users (nullable)
- `ip_address` - Visitor IP
- `user_agent` - Browser user agent
- `viewed_at` - View timestamp

**Indexes:**
- `property_id`, `user_id`, `viewed_at`

---

### 9. **property_favorites**
User wishlist/favorites (Many-to-Many).

**Columns:**
- `id` - Primary key
- `user_id` - FK to users
- `property_id` - FK to properties
- `created_at` - Timestamp

**Indexes:**
- Unique: `(user_id, property_id)`
- Individual: `user_id`, `property_id`

---

## Relationships

### Property Model Relationships:
- `belongsTo`: PropertyType, Bhk, City, Location, ProjectStatus, Builder, User
- `hasMany`: PropertyImage, PropertyInquiry, PropertyView, PropertyFavorite
- `hasOne`: PropertySpecification, MainImage
- `belongsToMany`: Amenity (through property_amenities)

### Builder Model Relationships:
- `hasMany`: Property

### Amenity Model Relationships:
- `belongsToMany`: Property (through property_amenities)

---

## Search & Filter Optimization

### Indexed Columns for Fast Filtering:
1. **City-based search**: `city_id` index
2. **Location-based search**: `location_id` index
3. **Property type filter**: `property_type_id` index
4. **BHK filter**: `bhk_id` index
5. **Price range filter**: `price` index
6. **Status filter**: `project_status_id` index
7. **Builder filter**: `builder_id` index
8. **Featured properties**: `is_featured` index
9. **Verified listings**: `is_verified` index

### Composite Index for Complex Queries:
- `idx_search` (city_id, property_type_id, bhk_id, price) - Optimizes multi-filter searches

### Full-Text Search:
- `idx_fulltext` on (title, description) - Enables fast text search

---

## Query Examples

### 1. Search Properties with Filters
```php
$properties = Property::query()
    ->active()
    ->published()
    ->filterByCity($cityId)
    ->filterByPropertyType($propertyTypeId)
    ->filterByBhk($bhkId)
    ->filterByPriceRange($minPrice, $maxPrice)
    ->filterByProjectStatus($statusId)
    ->with(['city', 'location', 'propertyType', 'bhk', 'builder', 'mainImage'])
    ->paginate(20);
```

### 2. Get Featured Properties
```php
$featured = Property::active()
    ->published()
    ->featured()
    ->with(['city', 'mainImage', 'amenities'])
    ->limit(6)
    ->get();
```

### 3. Get Property with All Details
```php
$property = Property::with([
    'propertyType',
    'bhk',
    'city',
    'location',
    'projectStatus',
    'builder',
    'images',
    'amenities',
    'specifications'
])->findOrFail($id);
```

### 4. Search by Text
```php
$properties = Property::search($searchTerm)
    ->active()
    ->published()
    ->paginate(20);
```

---

## Best Practices Implemented

1. ✅ **Normalized Structure** - No comma-separated values
2. ✅ **Proper Indexing** - Optimized for search and filtering
3. ✅ **Foreign Key Constraints** - Data integrity maintained
4. ✅ **Soft Deletes** - Properties can be recovered
5. ✅ **Timestamps** - Track creation and updates
6. ✅ **Pivot Tables** - Many-to-many relationships (amenities, favorites)
7. ✅ **Enum Types** - Predefined values for status fields
8. ✅ **Decimal Precision** - Accurate price and area storage
9. ✅ **Composite Indexes** - Fast multi-column queries
10. ✅ **Full-Text Search** - Efficient text searching

---

## Scalability Features

1. **Separate Tables** - Each entity has its own table
2. **Indexed Columns** - Fast queries even with millions of records
3. **Eager Loading** - Prevent N+1 query problems
4. **Caching Ready** - Structure supports Redis/Memcached
5. **Partitioning Ready** - Can partition by city_id or created_at
6. **Read Replicas** - Structure supports master-slave setup

---

## Next Steps

1. Create admin CRUD controllers for properties
2. Create public property listing pages
3. Implement advanced search with filters
4. Add property comparison feature
5. Implement property recommendations
6. Add property alerts/notifications
7. Create property analytics dashboard

---

## Seeded Data

### Builders (5 records):
- DLF Limited
- Godrej Properties
- Prestige Group
- Sobha Limited
- Brigade Group

### Amenities (26 records):
- Basic: Power Backup, Lift, Water Supply, Parking, Maintenance Staff
- Security: 24x7 Security, CCTV, Intercom, Fire Safety, Gated Community
- Recreation: Swimming Pool, Gym, Club House, Play Area, Indoor Games, Jogging Track, Sports
- Convenience: Shopping Center, ATM, Visitor Parking, Multipurpose Hall, Laundry
- Eco-Friendly: Rain Water Harvesting, Solar Panels, Waste Management, Garden

---

## Database Schema Diagram

```
┌─────────────┐
│   users     │
└──────┬──────┘
       │
       │ (created_by)
       │
┌──────▼──────────────────────────────────────────────────────┐
│                      properties                              │
│  - id, title, slug, description                             │
│  - property_type_id, bhk_id, city_id, location_id          │
│  - project_status_id, builder_id                            │
│  - price, areas, coordinates                                │
│  - is_featured, is_verified, is_active                      │
└──┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┬───┘
   │   │   │   │   │   │   │   │   │   │   │   │   │   │
   │   │   │   │   │   │   │   │   │   │   │   │   │   └──► property_types
   │   │   │   │   │   │   │   │   │   │   │   │   └──────► bhks
   │   │   │   │   │   │   │   │   │   │   │   └──────────► cities
   │   │   │   │   │   │   │   │   │   │   └──────────────► locations
   │   │   │   │   │   │   │   │   │   └──────────────────► project_statuses
   │   │   │   │   │   │   │   │   └──────────────────────► builders
   │   │   │   │   │   │   │   │
   │   │   │   │   │   │   │   └──► property_specifications (1:1)
   │   │   │   │   │   │   │
   │   │   │   │   │   │   └──────► property_images (1:N)
   │   │   │   │   │   │
   │   │   │   │   │   └──────────► property_inquiries (1:N)
   │   │   │   │   │
   │   │   │   │   └──────────────► property_views (1:N)
   │   │   │   │
   │   │   │   └──────────────────► property_favorites (M:N with users)
   │   │   │
   │   │   └──────────────────────► property_amenities (M:N)
   │   │                                      │
   │   │                                      ▼
   │   │                              ┌───────────┐
   │   │                              │ amenities │
   │   │                              └───────────┘
   │   │
   └───┴──────────────────────────────────────────────────────┘
```

---

Generated on: 2026-02-12
Laravel Version: 11.x
Database: MySQL 8.0+
