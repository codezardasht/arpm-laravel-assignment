# ARPM Laravel Developer Assessment

![Laravel Logo](https://laravel.com/img/logomark.min.svg)

## About

The ARPM Laravel Developer Assessment is a complete Laravel-based project designed to demonstrate backend development skills through five comprehensive tasks. These tasks cover real-world topics such as Eloquent optimization, data visualization, testing, collection manipulation, and Laravel Q&A. Each feature is modular, testable, and production-ready.

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Features](#2-features)
3. [Technologies](#3-technologies)
4. [Installation](#4-installation)
    - [System Requirements](#41-system-requirements)
    - [Running Locally](#42-running-locally)
5. [Testing](#5-testing)
6. [API Documentation](#6-api-documentation)
7. [Architecture](#7-architecture)
8. [Environment Variables](#8-environment-variables)
9. [Credits](#9-credits)
10. [License](#10-license)

---

## 1. Project Overview

This Laravel project contains 5 developer tasks implemented in a clean architecture:

- Task 1: Uniform data generation & cumulative visualization
- Task 2: Refactored controller & optimized database access
- Task 3: Service testing with PHPUnit
- Task 4: Elegant Laravel Collection usage
- Task 5: Conceptual Q&A in PDF format

---

## 2. Features

- ✅ Cumulative data chart with Google Sheets
- ✅ Efficient Eloquent model usage
- ✅ Fully tested service class with real-life scenarios
- ✅ Smart collection logic using Laravel's `Collection` API
- ✅ Clean project structure with service and action classes
- ✅ Modular routing and controllers

---

## 3. Technologies

- **Framework**: Laravel 12.x
- **Language**: PHP 8.3
- **Database**: MySQL
- **Testing**: PHPUnit
- **Utilities**: Laravel Artisan, Validator, Job Dispatching
- **Charting**: Google Sheets
- **Version Control**: Git & GitHub

---

## 4. Installation

### 4.1 System Requirements

- PHP >= 8.2
- Composer
- MySQL or MariaDB
- Laravel CLI

### 4.2 Running Locally

```bash
git clone https://github.com/codezardasht/arpm-laravel-assignment.git
cd arpm-laravel-assignment

# Install PHP dependencies
composer install

# Copy .env file and setup database credentials
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Serve the application
php artisan serve
```

### 4.3 Running with Docker

```bash
# Build and start containers
docker compose up -d --build
```

After running, access the application at:

- 🌐 http://127.0.0.1:8008/
- 🐘 phpMyAdmin: http://127.0.0.1:8098/

#### Docker `.env` Configuration:

```dotenv
DB_CONNECTION=mysql
DB_HOST=arpm-database
DB_PORT=3306
DB_DATABASE=arpm_laravel_assessment
DB_USERNAME=arpm
DB_PASSWORD=arpm
```

```bash
git clone https://github.com/codezardasht/arpm-laravel-assignment.git
cd arpm-laravel-assignment

# Install PHP dependencies
composer install

# Copy .env file and setup database credentials
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate --seed

# Serve the application
php artisan serve
```

---

## 5. Testing

Run the unit tests with:

```bash
php artisan test
```

```bash
# Run all tests
docker exec -it arpm-backend php artisan test

# Generate coverage report
docker exec -it arpm-backend XDEBUG_MODE=coverage php artisan test --coverage

# Run tests in parallel
docker exec -it arpm-backend php artisan test --parallel
```

Relevant test file for Task 3:  
📄 [`SpreadsheetServiceTest.php`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/tests/Unit/Services/SpreadsheetServiceTest.php)

---

## 6. API Documentation

This assessment contains internal routes used in tasks:

- `GET /orders` — returns optimized order data  
  ➤ Controller: [`OrderController`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Http/Controllers/OrderController.php)  
  ➤ Service: [`OrderService`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Services/OrderService.php)

- `GET /office-employees` — returns employees grouped by office  
  ➤ Controller: [`OfficeController`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Http/Controllers/OfficeController.php)  
  ➤ Action: [`GetOfficeEmployees`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Actions/GetOfficeEmployees.php)

---

## 7. Architecture

The application follows Laravel service-action-based structure:

```
app/
├── Actions/               # Business logic (e.g., GetOfficeEmployees)
├── Services/              # Encapsulated service logic (e.g., OrderService)
├── Http/
│   └── Controllers/       # API Controllers
├── Models/                # Eloquent Models
├── Jobs/                  # Dispatched jobs (e.g., ProcessProductImage)
├── Tests/                 # PHPUnit Test Cases
```

- **Actions**: Perform isolated, testable tasks
- **Services**: Reusable business logic with clean interfaces
- **Tests**: Validate correctness with `php artisan test`

---

## 8. Environment Variables

Besides Laravel defaults, ensure your `.env` contains:

| Variable      | Description              | Example     |
|---------------|--------------------------|-------------|
| APP_ENV       | Application environment  | `local`     |
| DB_DATABASE   | Database name            | `arpm_test` |
| DB_USERNAME   | Database user            | `root`      |
| DB_PASSWORD   | Database password        | `root`      |



## 9. Credits

- [Zardasht Ismael](https://github.com/codezardasht) — Laravel Developer & Task Author

### Links to Tasks

- **Task 1: Google Sheet**  
  🔗 [View Sheet](https://docs.google.com/spreadsheets/d/1t3BeHaQlkGzHZPBwem795UuupKh95AY4S6CPNVHw4rI/edit?usp=sharing)

- **Task 2: Controller Refactor**  
  🔗 [`OrderController`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Http/Controllers/OrderController.php)  
  🔗 [`OrderService`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Services/OrderService.php)

- **Task 3: Unit Test**  
  🔗 [`SpreadsheetServiceTest`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/tests/Unit/Services/SpreadsheetServiceTest.php)

- **Task 4: Collections**  
  🔗 [`OfficeController`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Http/Controllers/OfficeController.php)  
  🔗 [`GetOfficeEmployees`](https://github.com/codezardasht/arpm-laravel-assignment/blob/main/app/Actions/GetOfficeEmployees.php)

- **Task 5: Q&A PDF**  
  Include PDF

---

## 11. License

This assessment project is provided for evaluation and educational purposes only. All rights reserved by the author.

© 2025 Zardasht Ismael
