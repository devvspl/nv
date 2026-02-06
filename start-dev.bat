@echo off
echo Starting Laravel Development Server...
echo.
echo Make sure you have:
echo 1. Configured your .env file
echo 2. Run 'composer install'
echo 3. Run 'npm install && npm run build'
echo 4. Run 'php artisan migrate'
echo.
echo Starting server at http://localhost:8000
echo Press Ctrl+C to stop the server
echo.
php artisan serve