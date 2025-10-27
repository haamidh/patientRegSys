# Patient Registration System

A modern patient registration and management system built with Laravel 11, Inertia.js, and Vue 3. This application allows public patient registration and provides an admin dashboard for managing patient records.

## 🚀 Tech Stack

### Backend
- **Laravel 11** - PHP framework
- **PHP 8.2** - Server-side language
- **MySQL 8.0** - Database
- **Inertia.js** - Server-side rendering adapter
- **Laravel Fortify** - Authentication system

### Frontend
- **Vue 3** - JavaScript framework
- **TypeScript** - Type-safe JavaScript
- **Vite** - Build tool and dev server
- **Tailwind CSS** - Utility-first CSS framework
- **Lucide Vue** - Icon library

### DevOps
- **Docker** - Containerization
- **Docker Compose** - Multi-container orchestration
- **Nginx** - Web server
- **PHP-FPM** - FastCGI process manager

### Testing
- **Pest PHP** - Testing framework
- **PHPUnit** - Unit testing

## 📋 Features

- ✅ Public patient registration
- ✅ Admin authentication and authorization
- ✅ Patient CRUD operations (Create, Read, Update, Delete)
- ✅ Soft deletes for patient records
- ✅ Search functionality in patient dashboard
- ✅ Responsive design
- ✅ Form validation (client & server-side)
- ✅ Phone number sanitization (digits only)
- ✅ Age calculation from date of birth

## 📁 Project Structure

```
patientRegSys/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PatientController.php      # Patient CRUD logic
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php        # Admin authorization
│   │   ├── Requests/
│   │   │   ├── StorePatientRequest.php    # Create validation
│   │   │   └── UpdatePatientRequest.php   # Update validation
│   │   └── Responses/
│   │       └── LoginResponse.php          # Custom login redirect
│   ├── Models/
│   │   ├── Patient.php                    # Patient model with SoftDeletes
│   │   └── User.php                       # User model
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── FortifyServiceProvider.php     # Auth configuration
├── database/
│   ├── factories/
│   │   ├── PatientFactory.php             # Patient test data
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── *_create_patients_table.php
│   │   └── *_add_is_admin_to_users_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── docker/
│   ├── nginx/
│   │   └── default.conf                   # Nginx configuration
│   └── php/
│       └── Dockerfile                     # PHP-FPM container
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   └── LogoutButton.vue
│   │   ├── pages/
│   │   │   ├── admin/
│   │   │   │   ├── PatientDashboard.vue   # Admin patient list
│   │   │   │   └── EditPatient.vue        # Edit patient form
│   │   │   ├── Welcome.vue                # Landing page
│   │   │   ├── PatientRegister.vue        # Public registration
│   │   │   └── ThankYou.vue               # Success page
│   │   ├── app.ts                         # Main entry point
│   │   └── ssr.ts                         # Server-side rendering
│   └── css/
│       └── app.css                        # Tailwind styles
├── routes/
│   ├── web.php                            # Application routes
│   └── settings.php                       # Additional routes
├── tests/
│   ├── Feature/
│   │   ├── AdminPatientCrudTest.php       # Admin CRUD tests
│   │   ├── PatientRegistrationTest.php    # Registration tests
│   │   └── PatientValidationTest.php      # Validation tests
│   └── TestCase.php
├── .env                                   # Environment variables
├── docker-compose.yml                     # Docker services
├── package.json                           # Node dependencies
├── composer.json                          # PHP dependencies
├── vite.config.ts                         # Vite configuration
└── tsconfig.json                          # TypeScript configuration
```

## 🔧 Setup Instructions

### Prerequisites

- Docker Desktop installed
- Node.js 20.19+ or 22.12+ (for local development)
- Composer (optional, for local development)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/haamidh/patientRegSys.git
   cd patientRegSys
   ```

2. **Copy environment file**
   ```bash
   cp .env.example .env
   ```

3. **Start Docker containers**
   ```bash
   docker compose up -d --build
   ```

4. **Install PHP dependencies** (inside container)
   ```bash
   docker compose exec app composer install
   ```

5. **Generate application key**
   ```bash
   docker compose exec app php artisan key:generate
   ```

6. **Run database migrations**
   ```bash
   docker compose exec app php artisan migrate
   ```

7. **Seed the database** (optional - creates test data)
   ```bash
   docker compose exec app php artisan db:seed
   ```

8. **Install Node dependencies**
   ```bash
   npm install
   ```

9. **Build frontend assets**
   ```bash
   npm run build
   ```

10. **Access the application**
    - Frontend: http://localhost:8080
    - Database: localhost:3306

### Create Admin User

```bash
docker compose exec app php artisan tinker
```

Then in Tinker:
```php
$user = App\Models\User::factory()->create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => true
]);
exit
```

## 🌍 Environment Variables

Key environment variables in `.env`:

```bash
# Application
APP_NAME="Patient Registration System"
APP_ENV=local
APP_KEY=                              # Generated by artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8080

# Database
DB_CONNECTION=mysql
DB_HOST=db                            # Docker service name
DB_PORT=3306
DB_DATABASE=patientregsys
DB_USERNAME=homestead
DB_PASSWORD=secret

# Session
SESSION_DRIVER=database              # Store sessions in DB
SESSION_LIFETIME=120                 # Minutes

# Cache
CACHE_STORE=database

# Queue
QUEUE_CONNECTION=database

# Mail (for password reset)
MAIL_MAILER=log                      # Change to smtp for production
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 🎯 Common Commands

### Docker Commands

```bash
# Start containers
docker compose up -d

# Stop containers
docker compose down

# View logs
docker compose logs -f

# Rebuild containers
docker compose up -d --build

# Access app container shell
docker compose exec app bash

# Access MySQL
docker compose exec db mysql -u homestead -psecret -D patientregsys
```

### Laravel Artisan Commands

```bash
# Clear caches
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan view:clear

# Run migrations
docker compose exec app php artisan migrate

# Rollback migrations
docker compose exec app php artisan migrate:rollback

# Fresh migration with seed
docker compose exec app php artisan migrate:fresh --seed

# Create new migration
docker compose exec app php artisan make:migration create_table_name

# Create new controller
docker compose exec app php artisan make:controller ControllerName

# Create new model with migration and factory
docker compose exec app php artisan make:model ModelName -mf

# Run Tinker (interactive shell)
docker compose exec app php artisan tinker

# List routes
docker compose exec app php artisan route:list
```

### Frontend Commands

```bash
# Install dependencies
npm install

# Development server (with hot reload)
npm run dev

# Production build
npm run build

# Type check
npm run type-check
```

### Testing Commands

```bash
# Run all tests
docker compose exec app php artisan test

# Run specific test file
docker compose exec app php artisan test --filter=AdminPatientCrudTest

# Run tests with coverage
docker compose exec app php artisan test --coverage

# Run specific test method
docker compose exec app php artisan test --filter=test_admin_can_delete_patient
```

### Database Commands

```bash
# Access MySQL CLI
docker compose exec db mysql -u homestead -psecret -D patientregsys

# Export database
docker compose exec db mysqldump -u homestead -psecret patientregsys > backup.sql

# Import database
docker compose exec -T db mysql -u homestead -psecret patientregsys < backup.sql

# Check database tables
docker compose exec db mysql -u homestead -psecret -D patientregsys -e "SHOW TABLES;"

# View patient records
docker compose exec db mysql -u homestead -psecret -D patientregsys -e "SELECT * FROM patients LIMIT 10;"
```

## 🧪 Running Tests

The application includes comprehensive feature tests:

```bash
# Run all tests
docker compose exec app php artisan test

# Run with detailed output
docker compose exec app php artisan test --parallel

# Run specific test suite
docker compose exec app php artisan test tests/Feature/AdminPatientCrudTest.php
```

### Test Coverage

- ✅ Admin authentication and authorization
- ✅ Patient CRUD operations
- ✅ Form validation (email, phone, required fields)
- ✅ Guest access restrictions
- ✅ Soft delete functionality
- ✅ Public patient registration flow

## 🔐 User Roles

### Admin User
- Can access `/admin/patients` dashboard
- Can view all patients
- Can edit patient information
- Can delete patients (soft delete)
- Can search patients

### Guest User
- Can register new patients at `/register-patient`
- Cannot access admin routes
- Redirected to login when accessing protected routes

## 🛠️ Development Workflow

1. **Make code changes**
   - Backend: Edit PHP files in `app/`, `routes/`, etc.
   - Frontend: Edit Vue components in `resources/js/`

2. **Clear caches** (if needed)
   ```bash
   docker compose exec app php artisan config:clear
   docker compose exec app php artisan cache:clear
   ```

3. **Rebuild frontend** (if JS/CSS changed)
   ```bash
   npm run build
   ```
   Or use dev mode with hot reload:
   ```bash
   npm run dev
   ```

4. **Run tests**
   ```bash
   docker compose exec app php artisan test
   ```

5. **Check logs** (if errors occur)
   ```bash
   docker compose logs -f app
   # Or check Laravel logs
   docker compose exec app tail -f storage/logs/laravel.log
   ```

## 📝 API Routes

### Public Routes
- `GET /` - Welcome page
- `GET /register-patient` - Patient registration form
- `POST /register-patient` - Submit patient registration
- `GET /thankyou` - Registration success page

### Auth Routes (Fortify)
- `GET /login` - Login page
- `POST /login` - Authenticate user
- `POST /logout` - Logout user

### Admin Routes (requires auth + admin)
- `GET /admin/patients` - Patient list with search
- `GET /admin/patients/{patient}/edit` - Edit patient form
- `PUT /admin/patients/{patient}` - Update patient
- `DELETE /admin/patients/{patient}` - Soft delete patient

## 🐛 Troubleshooting

### Port already in use
```bash
# Change ports in docker-compose.yml or stop conflicting services
docker compose down
# Edit docker-compose.yml ports section
docker compose up -d
```

### Permission denied errors
```bash
# Fix storage permissions
docker compose exec app chmod -R 777 storage bootstrap/cache
```

### 504 Gateway Timeout
- Check PHP-FPM logs: `docker compose logs app`
- Check for syntax errors in validation rules
- Increase timeout in `docker/nginx/default.conf`

### Frontend assets not loading
```bash
# Rebuild assets
npm run build
# Clear browser cache or hard reload (Ctrl+F5)
```

### Database connection failed
```bash
# Check MySQL is running
docker compose ps
# Check credentials in .env match docker-compose.yml
# Restart containers
docker compose restart
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👥 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📞 Support

For support, email haamidh@example.com or open an issue in the repository.

---

**Built with ❤️ using Laravel, Vue, and Docker**
