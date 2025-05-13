# Eventify - Event Management System

Eventify is a Laravel-based application for creating, managing, and registering for events. This system is designed for organizations like schools or student associations to easily manage their events and attendees.

## Features

- User registration and authentication
- Event creation, editing, and deletion
- Event registration for users
- Admin dashboard with statistics
- User-friendly interface built with Tailwind CSS and Alpine.js

## Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and NPM

### Installation Steps

1. Clone the repository
2. Install PHP dependencies:
   ```
   composer install
   ```
3. Install NPM dependencies:
   ```
   npm install
   ```
4. Copy `.env.example` to `.env` and configure your environment:
   ```
   cp .env.example .env
   ```
5. Generate application key:
   ```
   php artisan key:generate
   ```
6. Run migrations:
   ```
   php artisan migrate
   ```
7. (Optional) Seed the database with sample data:
   ```
   php artisan db:seed
   ```
8. Compile assets:
   ```
   npm run dev
   ```
9. Start the development server:
   ```
   php artisan serve
   ```

### Default Users

When seeding the database, two default users are created:

- Admin: admin@example.com / password
- Regular User: user@example.com / password

## Usage

- Visit `/register` to create a new account
- Visit `/login` to log into an existing account
- Browse events on the homepage
- Click on an event to view details and register
- Use the dashboard to manage your events and registrations

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
