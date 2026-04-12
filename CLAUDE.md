# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the ERP system of Indotek Group, built with Laravel 10 and PHP 8.2. The application integrates with external systems (Firebird databases, Jira, iRems API) and uses Livewire 3 for interactive components.

## Development Commands

### Environment Setup
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Start development server
npm run dev

# Build assets for production
npm run build
```

### Docker Development
```bash
# Start containers (web server on port 5000, Redis, Mailhog, Firebird)
docker compose up -d

# Access application container
docker exec -it erp bash
```

The application runs in Docker with:
- Web server: `http://localhost:5000`
- Mailhog UI: `http://localhost:5005`
- Redis on port 6379
- Firebird on port 3050

### Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run specific test file
php artisan test tests/Unit/SomeTest.php
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Format specific files
./vendor/bin/pint app/Services/SomeService.php
```

### After Deployment / New Endpoint Setup
When adding new protected endpoints, run these seeders in Docker to update permissions:
```bash
php artisan db:seed --class=RoutePermissionSeeder
php artisan db:seed --class=NavigationPermissionSeeder
php artisan db:seed --class=CustomPermissionSeeder
```

This automatically assigns new permissions to the admin role.

### User Language Settings
To enable user language settings:
```bash
php artisan db:seed --class=UserLanguageSettingsSeeder
```

## Architecture

### Service Layer Pattern
The application heavily uses a service layer architecture. Business logic lives in `app/Services/` organized by domain:

- **Organizations/** - Organization management and SUP integration
- **Partners/** - Partner/customer management
- **Jira/** - Jira API integration
- **DBConnector/** - Database connection services for external systems
- **AppScaffold/** - Core application scaffolding (users, permissions, logging)
- **Files/** - File handling
- **Excel/** - Excel import/export functionality
- **AccountsReceivable/** - Accounts receivable management
- **Contracts/** - Contract management
- **RealEstate/** - Real estate/property management

Services contain the core business logic and are called from controllers. Keep controllers thin and move complex logic to services.

### Repository Pattern
The application uses repositories for data access abstraction (`app/Repositories/`). Repositories handle database queries and return Eloquent models or collections. This pattern provides a clean separation between business logic (services) and data access (repositories).

### Controllers Organization
Controllers are organized by API versioning and domain:
- `app/Http/Controllers/Api/V1/` - Versioned API controllers
- `app/Http/Controllers/Api/` - Non-versioned API controllers organized by domain
- Controllers delegate to services for business logic

### Models
Models are located in `app/Models/` and organized by domain (e.g., `AppScaffold/`, `Organizations/`, `Partners/`, `Jira/`). Many models use:
- Spatie Permission for role-based access control
- Laravel Auditing for change tracking
- Composite primary keys (via `HasCompositePrimaryKey` trait)

### Livewire Components
Interactive UI components are in `app/Livewire/` organized by domain. Components use Livewire 3 and PowerGrid for data tables.

### Authentication & Authorization
- Uses Laravel Sanctum for API token authentication
- Spatie Permission package for roles and permissions
- Permission seeding is critical for new endpoints (see deployment section)
- User model: `App\Models\AppScaffold\app_user`

### API Routes
- Main API routes: `routes/api.php` (extensive file with ~1000+ lines)
- API authentication via Sanctum tokens
- Many routes protected by permission middleware

### Database Connections
The application connects to multiple databases:
- **MySQL** - Primary application database
- **Firebird** - External economic organization databases (dynamic connections via `FirebirdEconomicOrganizationDatabaseConfigurator`)
- **PostgreSQL** - Some integrations use Postgres

Dynamic Firebird database connections are configured at runtime based on economic organization data.

### External Integrations
- **Jira API** - Issue tracking integration (`app/Services/Jira/`)
- **iRems API** - Property management system integration (`app/Services/iRemsApi/`)
- **SUP (Szállító Partner)** - Partner synchronization system
- **XML integrations** - Various XML-based data exchanges (`app/Services/Xml/`)

### Helper Functions
Global helper functions are autoloaded from `app/Helpers/Common/helpers.php`. Common helpers include:
- `forcur()` - Currency formatting
- `jira_format_datetime()` - Jira datetime formatting

### Asset Pipeline
Uses Vite for asset compilation:
- SCSS source: `resources/stylesheets/scss/src/app.scss`
- JavaScript entry: `resources/js/app.js`
- Frontend dependencies: Tailwind CSS, Flowbite, jQuery, TomSelect, SweetAlert2, Flatpickr

### Background Jobs
Job classes in `app/Jobs/` handle async processing. Use Laravel queues for long-running tasks.

## Key Conventions

### Naming
- Models use `snake_case` for table names (e.g., `app_user`, `economic_organizations`)
- Some models use composite primary keys
- Service classes follow `[Domain]Service.php` pattern
- Repository classes follow `[Domain]Repository.php` pattern

### Permission Management
After creating new routes with middleware protection:
1. Run `RoutePermissionSeeder` to detect new routes
2. Run `NavigationPermissionSeeder` to update navigation permissions
3. Permissions are automatically assigned to admin role
4. Custom permissions require `CustomPermissionSeeder`

### Database Seeders
Seeders in `database/seeders/` are critical for setup. Key seeders:
- Permission seeders (RoutePermissionSeeder, NavigationPermissionSeeder, CustomPermissionSeeder)
- Base data seeders (CountrySeeder, BaseCurrencySeeder)
- Module seeders (AppModuleSeeder, AppRoleSeeder)

### Testing
Tests are organized in:
- `tests/Unit/` - Unit tests
- `tests/Feature/` - Feature/integration tests
- `tests/SoftwareArchitecturalObjects/` - Architecture tests

## Working with External Databases

When working with Firebird economic organization databases:
1. Connection configurations are stored in the database
2. Use `FirebirdEconomicOrganizationDatabaseConfigurator` for dynamic connections
3. The `harrygulliford/laravel-firebird` package provides Firebird support
4. Firebird charset is UTF8

## Common Gotchas

- This is a Hungarian ERP system - many business terms and some code comments are in Hungarian
- The application uses both snake_case and camelCase naming depending on context
- Permission system requires seeding after route changes - this is critical for access control
- Some services need access to multiple database connections simultaneously
- Livewire components may use PowerGrid for complex data tables

## Git Workflow

### Before Making Changes
**Always ask for confirmation before:**
- Adding files to git (`git add`)
