# Laravel Authentication Project with Velok Theme

This Laravel project includes a complete authentication system using the Velok admin dashboard theme.

## Features

- **Authentication System**: Login, Register, Forgot Password
- **Custom Theme**: Velok responsive admin dashboard template
- **Laravel Breeze**: Complete authentication scaffolding
- **Blade Templates**: Converted HTML theme to Laravel Blade templates
- **Dashboard**: Basic dashboard with sample widgets

## Project Structure

```
├── resources/views/auth/
│   ├── login.blade.php          # Sign In page
│   ├── register.blade.php       # Sign Up page
│   └── forgot-password.blade.php # Reset Password page
├── resources/views/
│   └── dashboard.blade.php      # Main dashboard
├── public/assets/               # Theme assets (CSS, JS, Images)
│   ├── css/
│   ├── js/
│   └── images/
└── routes/web.php              # Application routes
```

## Setup Instructions

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
Configure your database in `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:
```bash
php artisan migrate
```

### 4. Build Assets
```bash
npm run build
```

### 5. Serve the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## Authentication Routes

- **Login**: `/login`
- **Register**: `/register`
- **Forgot Password**: `/forgot-password`
- **Dashboard**: `/dashboard` (requires authentication)

## Theme Assets

The theme assets are located in `public/assets/` and include:
- **CSS**: `vendor.min.css`, `app.min.css`
- **JavaScript**: `vendor.js`, `app.js`, `config.min.js`
- **Images**: Logo files and other theme images

## Customization

### Adding Theme CSS/JS
You can add your theme CSS and JS files to the `public/assets/` directory and include them in your Blade templates:

```blade
<link href="{{ asset('assets/css/your-custom.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/your-custom.js') }}"></script>
```

### Modifying Authentication Views
The authentication views are located in `resources/views/auth/` and can be customized as needed.

### Dashboard Customization
The dashboard view is located at `resources/views/dashboard.blade.php` and includes sample widgets that can be customized.

## Commands

### Development
```bash
# Serve the application
php artisan serve

# Watch for asset changes
npm run dev

# Build assets for production
npm run build
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

## Security Features

- CSRF protection on all forms
- Password hashing
- Email verification (can be enabled)
- Rate limiting on authentication routes
- Secure session management

## Next Steps

1. **Add Theme Assets**: Copy your theme's CSS, JS, and image files to `public/assets/`
2. **Customize Dashboard**: Modify `resources/views/dashboard.blade.php` with your content
3. **Add More Pages**: Create additional views and routes as needed
4. **Configure Email**: Set up email configuration for password reset functionality
5. **Add User Roles**: Implement role-based access control if needed

## Support

For Laravel documentation, visit: https://laravel.com/docs
For Laravel Breeze documentation, visit: https://laravel.com/docs/starter-kits#laravel-breeze