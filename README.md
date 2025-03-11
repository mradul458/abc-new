

Glofox.....

Overview

I have completed this task in Laravel, implementing APIs for:

Creating classes

Booking a class

Additionally, I have documented the API using Swagger and implemented basic test cases using Laravel's built-in testing framework.

Features Implemented

API Endpoints for managing classes and bookings.

Database Storage: Data is stored in a database instead of memory or cache.

Validation: Input validation is implemented to ensure data integrity.

API Documentation using Swagger.

Test Cases using Laravel's built-in unit testing.

API Documentation

I have created API documentation using Swagger.

📄 Swagger Documentation URL:

http://127.0.0.1:8000/api/documentation

You can visit this link to explore and test the available API endpoints.

Test Cases

I have written basic test cases using Laravel's built-in testing framework to ensure:

Class creation works as expected

Booking a class is successful

Validation errors are handled properly

Run the tests using:

php artisan test

Setup Instructions

To run this project locally, follow these steps:

1. Clone the repository

git clone <repository_url>
cd <project_directory>

2. Install Dependencies

composer install

3. Setup Environment

Copy .env.example to .env:

cp .env.example .env

Update database credentials in .env:

DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

4. Run Migrations

php artisan migrate

5. Serve the Application

php artisan serve

Visit http://127.0.0.1:8000 to test the API.

Running Swagger Documentation

If Swagger UI is not working, regenerate the documentation:

php artisan l5-swagger:generate

Running Tests

Run all test cases using:

php artisan test

Conclusion

This project implements a Class Management & Booking System in Laravel, following best practices. It includes:
✅ API Endpoints
✅ Database Storage
✅ Validation
✅ API Documentation (Swagger)
✅ Test Cases

Feel free to extend or modify the project as needed. 🚀
