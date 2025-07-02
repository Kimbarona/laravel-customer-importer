Laravel Customer Importer Challenge
This project is a coding challenge for importing customer data from the Random User API using Laravel 12 and Doctrine ORM. It demonstrates clean code architecture, service reusability, third-party API integration, and test coverage.

✨ Features
✅ Import Australian customers from the Random User API

✅ Reusable service class (CustomerImporter)

✅ Doctrine ORM integration

✅ Console command: php artisan import:customers {count}

✅ Stores customers in a relational database

✅ Updates existing customers by email (idempotent)

✅ Passwords are stored using md5() hashing

✅ RESTful API endpoints to list and view customers

✅ Configurable API URL via config/services.php

✅ Logs import activity via Laravel's logger

🧪 Testing
Unit and Feature tests using PHPUnit

API responses are mocked — no real HTTP calls

Both positive and negative test cases included

Ensures importer handles bad API responses gracefully

🔧 Setup Instructions
Clone the repository

Run composer install

Configure your .env and database

Run php atisan serve

Run migrations using this command "php artisan doctrine:schema:update --force"

Run php artisan import:customers

Access the API at /api/customers
