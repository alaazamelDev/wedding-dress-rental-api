# Wedding Dress Rental Service - Backend

![Laravel](https://img.shields.io/badge/Laravel-11.x-red) ![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-blue) ![License](https://img.shields.io/badge/license-MIT-green)

## About

This project is the backend API for a Wedding Dress Rental Service, built with PHP and Laravel 11. It provides functionality for managing dresses, handling user reservations, and implementing user authentication. This backend serves as the core system for managing rental operations, storing data, and handling requests.

## Features

- **User Authentication**: Register, login, and manage user accounts.
- **Dress Management**: Manage wedding dresses, including details like size, price, and availability.
- **Reservation System**: Allows users to reserve dresses, track reservations, and view reservation history.
- **Validation and Error Handling**: Ensures data integrity and provides meaningful error messages.
- **Code Quality**: Clean, well-documented code following Laravel best practices.

## Getting Started

Follow these instructions to set up the project locally.

### Prerequisites

- **PHP >= 8.1**
- **Composer**
- **MySQL or any compatible database**
- **Node.js & NPM** (optional, if you need to run any scripts)

### Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/alaazamelDev/wedding-dress-rental-api.git
   cd wedding-dress-rental-api
   ```

2. **Install Dependencies**

   Install the PHP dependencies using Composer:

   ```bash
   composer install
   ```

3. **Environment Setup**

   Copy the `.env.example` file to `.env` and configure your database and other environment variables.

   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Set up your database and run migrations:

   ```bash
   php artisan migrate
   ```

6. **Seed Database (Optional)**

   If you want to populate the database with sample data, run:

   ```bash
   php artisan db:seed
   ```

### Running the Application

Start the local development server:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## API Endpoints

Below are some key API endpoints available in the project. For a complete list, please refer to the [API Documentation](https://documenter.getpostman.com/view/27792396/2sAXjNXW9K).

### Authentication

- **Register**: `POST /api/v1/auth/register`
- **Login**: `POST /api/v1/auth/login`
- **Get User Details**: `GET /api/v1/auth/user`

### Dresses

- **List Dresses**: `GET /api/v1/dresses`
- **Dress Details**: `GET /api/v1/dresses/{id}`

### Reservations

- **Create Reservation**: `POST /api/v1/reservation/reserve`
- **Complete Reservation**: `POST /api/v1/reservation/complete`
- **Get User Reservations**: `GET /api/v1/users/my-reservations`

## Code Quality and Best Practices

- Follows PSR-12 coding standards.
- Uses Laravel's built-in validation and error handling.
- Code is modular, clean, and well-documented for easy understanding and maintenance.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

For any questions or suggestions, please reach out to [alaaaldeenzamel@gmail.com](mailto:alaaaldeenzamel@gmail.com).
