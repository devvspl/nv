@echo off
echo Laravel Project Setup
echo =====================
echo.

echo Step 1: Installing Composer dependencies...
composer install
if %errorlevel% neq 0 (
    echo Error: Composer install failed
    pause
    exit /b 1
)

echo.
echo Step 2: Installing NPM dependencies...
npm install
if %errorlevel% neq 0 (
    echo Error: NPM install failed
    pause
    exit /b 1
)

echo.
echo Step 3: Copying environment file...
if not exist .env (
    copy .env.example .env
    echo .env file created
) else (
    echo .env file already exists
)

echo.
echo Step 4: Generating application key...
php artisan key:generate

echo.
echo Step 5: Building assets...
npm run build

echo.
echo Step 6: Running database migrations...
php artisan migrate
if %errorlevel% neq 0 (
    echo Warning: Database migration failed. Please configure your database in .env file
)

echo.
echo =====================
echo Setup Complete!
echo =====================
echo.
echo Next steps:
echo 1. Configure your database in .env file
echo 2. Run 'php artisan migrate' if database setup failed
echo 3. Run 'start-dev.bat' to start the development server
echo.
pause