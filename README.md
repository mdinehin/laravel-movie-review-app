# Laravel Movie Reviews

![Laravel Version](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP Version](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square&logo=php&logoColor=white)
![Composer Version](https://img.shields.io/badge/Composer-2.x-885630?style=flat-square&logo=composer&logoColor=white)
![MySQL Version](https://img.shields.io/badge/MySQL-9.x-4479A1?style=flat-square&logo=mysql&logoColor=white)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](LICENSE)

<a href="https://github.com/mdinehin/laravel-movie-reviews/actions/workflows/tests.yml"><img src="https://github.com/mdinehin/laravel-movie-reviews/workflows/Tests/badge.svg" alt="Tests"></a>
<a href="https://github.com/mdinehin/laravel-movie-reviews/actions/workflows/coding-standards.yml"><img src="https://github.com/mdinehin/laravel-movie-reviews/actions/workflows/coding-standards.yml/badge.svg" alt="Coding Standards"></a>

A Laravel application for browsing movies and reviews, featuring movie filtering, popularity rankings, rating-based sorting, and a responsive user interface built with Blade and Tailwind CSS.

The project demonstrates modern Laravel development practices, including Eloquent relationships, query scopes, and Blade components.

## Preview

![Application demo walkthrough](https://github.com/user-attachments/assets/4278ea25-8a92-4748-ad0e-b32bedbe36d5)

## Features

- Browse a collection of movies and add reviews.
- Search movies by title.
- Discover popular and highly rated movies.
- View average ratings and review counts.
- Responsive user interface for desktop and mobile devices.

## Prerequisites

The following software dependencies are required:

- PHP 8.3+
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://www.mysql.com/downloads/)

## Installation

1. Clone the repository `git clone https://github.com/mdinehin/laravel-movie-reviews.git`
2. Install PHP dependencies `composer install`
3. Copy the `.env.example` file to `.env` and fill in the database credentials
4. Generate the application key `php artisan key:generate`
5. Run database migrations `php artisan migrate`
6. Seed the database `php artisan db:seed`
7. Start the local server `php artisan serve`

Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser to access the application.

## Commands

| Command | Description |
| --- | --- |
| `php artisan test` | Run the tests |
| `php artisan migrate:fresh --seed` | Reset the database |
| `composer types:check` | Perform static code analysis |
