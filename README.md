# PharmaFlow — Pharmacy Management System

PharmaFlow is a Laravel-based Pharmacy Management System for managing medicines, categories, suppliers, purchases, inventory, sales, users, reports, notifications, and pharmacy operations.

## Tech Stack

- PHP 8.2+
- Laravel 8.83.27
- MySQL 8.x
- Blade, HTML, CSS, JavaScript
- Composer
- XAMPP / Windows MySQL for local development
- Railway for application deployment
- Aiven MySQL for hosted database

## Features

- Separate Admin and User login
- Role-based access control
- Dashboard
- Medicine/Product management
- Category management
- Supplier management
- Purchase and inventory management
- Sales management and date filtering
- Reports and analytics
- Notifications
- User management
- Profile and settings
- Database backup functionality
- Responsive pharmacy-themed UI
- Professional tables, forms, and status badges

## Requirements

Install:

- PHP 8.2 or higher
- Composer
- MySQL 8.x
- Git
- Node.js and npm (only needed when frontend assets must be rebuilt)

Check versions:

```powershell
php -v
composer -V
mysql --version
node -v
npm -v
```

## Installation — Windows

### 1. Clone the repository

```powershell
git clone https://github.com/Heet4023T/pharmaflow.git
cd pharmaflow
```

### 2. Install dependencies

```powershell
composer install
```

### 3. Create `.env`

If `.env` does not exist:

```powershell
Copy-Item .env.example .env
```

Never commit `.env` to GitHub.

### 4. Configure MySQL

Set the database values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmacy_management
DB_USERNAME=root
DB_PASSWORD=
```

Use your own MySQL password if required.

### 5. Create the database

```sql
CREATE DATABASE pharmacy_management;
```

### 6. Generate the application key

```powershell
php artisan key:generate
```

### 7. Run migrations

For a fresh database:

```powershell
php artisan migrate
```

If seed data is required:

```powershell
php artisan migrate --seed
```

**Do not run `migrate:fresh` on a database containing important data.**

### 8. Create the storage link

```powershell
php artisan storage:link
```

### 9. Clear Laravel caches

```powershell
php artisan optimize:clear
```

## Run the Application

Normally:

```powershell
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

If Laravel cannot bind to a port on Windows, use:

```powershell
php -S 127.0.0.1:8080 -t public
```

Then open:

```text
http://127.0.0.1:8080
```

Stop the server with `Ctrl + C`.

## Frontend Assets

If assets need rebuilding:

```powershell
npm install
npm run dev
```

For a production asset build:

```powershell
npm run production
```

If the repository already contains compiled assets, these commands may not be required for normal execution.

## Production Deployment

The production architecture is:

```text
User
  │
  ▼
Railway
  │
  │ Laravel / PharmaFlow
  ▼
Aiven MySQL
```

Railway environment variables should contain:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=<your-production-key>

DB_CONNECTION=mysql
DB_HOST=<Aiven-host>
DB_PORT=<Aiven-port>
DB_DATABASE=<Aiven-database>
DB_USERNAME=<Aiven-username>
DB_PASSWORD=<Aiven-password>
```

Never commit production credentials or `APP_KEY`.

## Database Backup / Migration

To create a backup of the local MySQL database:

```powershell
mysqldump -u root -p pharmacy_management > pharmacy_management.sql
```

The command will prompt for the password.

Keep the original local database untouched until the hosted database has been successfully verified.

## Useful Laravel Commands

```powershell
php artisan --version
php artisan list
php artisan optimize:clear
php artisan migrate
php artisan migrate:status
php artisan tinker
php artisan test
```

## Troubleshooting

### Composer errors

Check PHP:

```powershell
php -v
```

Then:

```powershell
composer install
```

### Database connection errors

Check `.env` and then clear cached configuration:

```powershell
php artisan optimize:clear
```

### `could not find driver`

Check that the MySQL PDO extension is enabled:

```powershell
php -m | Select-String pdo_mysql
```

### Application key error

```powershell
php artisan key:generate
```

For production, put the generated key in the hosting platform's environment variables.

### Port already in use

```powershell
php -S 127.0.0.1:8080 -t public
```

## Security

- Never commit `.env`.
- Never publish `APP_KEY`.
- Never publish database passwords.
- Use `APP_DEBUG=false` in production.
- Back up the database before destructive operations.
- Do not run `php artisan migrate:fresh` against a database containing important data.

## Project Information

**Project:** PharmaFlow — Pharmacy Management System  
**Repository:** https://github.com/Heet4023T/pharmaflow  
**Framework:** Laravel 8.83.27  
**Database:** MySQL  
**Deployment:** Railway  
**Hosted Database:** Aiven MySQL

## Team

- **Shivam Gupta** — 53013240018
- **Heet Gosalia** — 53013240008

## License

This project is intended for academic/project demonstration and educational use.
