# Translation Service API

A simple Laravel-based API for managing translations with support for tagging, searching, and exporting. Built using Laravel 12 and Sanctum for API authentication.

---

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Setup](#setup)
- [Authentication](#authentication)
- [API Endpoints](#api-endpoints)
- [Design Choices](#design-choices)

---

## Features

- Create, update, delete, and list translations.
- Tag translations for better organization.
- Search translations by key, locale, or tag.
- Export translations by locale.
- API authentication with Laravel Sanctum.

---

## Requirements

- PHP >= 8.1
- Composer
- Laravel 12
- MySQL or any supported database

---

## Installation

1. Clone the repository:

git clone <repo>
cd translation-service
Install dependencies:


composer install
Copy .env.example to .env and configure your database and Redis:


cp .env.example .env
Generate application key:


php artisan key:generate
Run migrations:


php artisan migrate
Start the server:


php artisan serve
Setup
Generate a test user token:


GET /api/token
Response:
Use this token in the Authorization header as Bearer <token> for all protected endpoints.

Authentication
This API uses Laravel Sanctum for token-based authentication. All endpoints except /api/token require a Bearer token.


Authorization: Bearer <your-token>

Accept: application/json
API Endpoints
Method	Endpoint	Description	Example URL
GET	/translations	List all translations	http://127.0.0.1:8000/api/translations
POST	/translations	Create a translation	http://127.0.0.1:8000/api/translations
GET	/translations/search	Search translations	http://127.0.0.1:8000/api/translations/search?key=greeting&locale=en&tag=home
GET	/translations/export	Export translations by locale	http://127.0.0.1:8000/api/translations/export?locale=en
PUT	/translations/{translation}	Update a translation	http://127.0.0.1:8000/api/translations/1
DELETE	/translations/{translation}	Delete a translation	http://127.0.0.1:8000/api/translations/1

Example POST Body:

{
  "key": "greeting",
  "locale": "en",
  "value": "Hello",
  "tags": ["common", "home"]
}


## Design Choices
Laravel Sanctum: Chosen for simple API token authentication without OAuth complexity.
Tags relationship: Translations can be tagged to allow filtering/searching by category.
Chunking in export: Prevents memory overload when exporting large numbers of translations.
Validation: All create/update requests validate required fields to maintain data integrity.

