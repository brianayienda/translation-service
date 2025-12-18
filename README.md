# Translation Service API

A simple Laravel-based API for managing translations with support for tagging, searching, and exporting. Built using Laravel 12 and Sanctum for API authentication.

---

## Table of Contents

-   [Features](#features)
-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Setup](#setup)
-   [Authentication](#authentication)
-   [API Endpoints](#api-endpoints)
-   [Design Choices](#design-choices)

---

## Features

-   Create, update, delete, and list translations.
-   Tag translations for better organization.
-   Search translations by key, locale, or tag.
-   Export translations by locale.
-   API authentication with Laravel Sanctum.

---

## Requirements

-   PHP >= 8.1
-   Composer
-   Laravel 12
-   MySQL or any supported database

---

## Installation

1. Clone the repository:

2. git clone https://github.com/brianayienda/translation-service.git
3. cd translation-service

4. composer install
5. Copy .env.example to .env and configure your database

6. cp .env.example .env

7. php artisan key:generate

8. php artisan migrate

Seed the DB with the 100K records
9. php artisan db:seed

10. php artisan serve

11. Generate a test user token:

GET /api/token
Response:
Use this token in the Authorization header as Bearer for all protected endpoints.

## Authentication
This API uses Laravel Sanctum for token-based authentication. All endpoints except /api/token require a Bearer token.
1. GET /token List all translations http://127.0.0.1:8000/api/token


Authorization: Bearer <your-token>

Accept: application/json

## API Endpoints

1. GET /translations List all translations http://127.0.0.1:8000/api/translations
2. POST /translations Create a translation http://127.0.0.1:8000/api/translations
3. GET /translations/search Search translations http://127.0.0.1:8000/api/translations/search?key=app.key_1&locale=en&tag=mobile
4. GET /translations/export Export translations by locale http://127.0.0.1:8000/api/translations/export?locale=en
5. PUT /translations/{translation} Update a translation http://127.0.0.1:8000/api/translations/1
6. DELETE /translations/{translation} Delete a translation http://127.0.0.1:8000/api/translations/1

Example POST Body:

{
"key": "greeting",
"locale": "en",
"value": "Hello",
"tags": ["common", "home"]
}

## Design Choices

1. Laravel Sanctum: Chosen for simple API token authentication without OAuth complexity.
2. Tags relationship: Translations can be tagged to allow filtering/searching by category.
3. Chunking in export: Prevents memory overload when exporting large numbers of translations.
4. Validation: All create/update requests validate required fields to maintain data integrity.
