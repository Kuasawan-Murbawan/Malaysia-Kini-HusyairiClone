# Malaysiakini-style News Portal

A full-stack news portal built as a skill assessment for AppAsia Berhad, demonstrating backend API development in Laravel and frontend in Angular. The design is inspired by [Malaysiakini's news listing page](https://www.malaysiakini.com/my/latest/news).

## Tech Stack

**Backend:** Laravel, MySQL, Eloquent ORM
**Frontend:** Angular (v22), TypeScript, RxJS, Signals

## Features

- REST API exposing news stories, categories, and comments as JSON
- Relational data model: stories belong to a category, optionally have an author, have many tags (many-to-many), and have many comments
- Category-based filtering via query parameter (`GET /api/news?category={slug}`)
- Responsive news listing page with a category menu
- Relative timestamps ("1h ago") on each story card
- Seeded with realistic category data and randomly generated (Faker) story/author content, with real placeholder images via Picsum

## Project Structure

```
Backend/    Laravel API (migrations, models, controllers, resources, seeders/factories)
Frontend/   Angular application (components, services)
```

## Setup Instructions

### Prerequisites

- PHP 8.2+ and Composer
- Node.js 20+ and npm
- MySQL (running locally, with a database created for this project)

### Backend (Laravel)

```bash
cd Backend
composer install
cp .env.example .env
php artisan key:generate
```

Update `.env` with your local MySQL credentials:

```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations and seed the database:

```bash
php artisan migrate:fresh --seed
```

Start the API server:

```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`.

### Frontend (Angular)

```bash
cd Frontend
npm install
ng serve
```

The app will be available at `http://localhost:4200`.

> Note: the Angular app expects the Laravel API to be running at `http://localhost:8000/api` (configured in `src/app/services/news.ts`). If your backend runs on a different port, update this value.

### CORS

If you see CORS errors in the browser console, confirm `config/cors.php` on the backend allows `http://localhost:4200` under `allowed_origins`, then restart `php artisan serve`.

## API Endpoints

| Method | Endpoint                  | Description                                                   |
| ------ | ------------------------- | ------------------------------------------------------------- |
| GET    | `/api/news`               | Paginated list of stories, optional `?category={slug}` filter |
| GET    | `/api/news/{id}`          | Full details of a single story                                |
| GET    | `/api/categories`         | List of all categories                                        |
| GET    | `/api/categories/{id}`    | Single category                                               |
| GET    | `/api/comments/{id}`      | Single comment                                                |
| GET    | `/api/news/{id}/comments` | Comments for a story                                          |

## What I Learned

This was my first project in Laravel and Angular, coming from a Java Spring Boot / React background. A few things that I learn:

- **Eloquent vs. JPA**: Eloquent relationships felt super familiar coming from JPA. That said, the way Laravel breaks things down—migrations, models, API resources, and pivot tables made setting up the many-to-many tags relationship feel really clean.

- **API Resources**: I loved using Laravel API Resources. It’s basically a lightweight way to make DTOs without the heavy template, keeping the database structure separate from what the frontend actually receives.

- **Angular's Signals & Standalone Components**: This was definitely the biggest change compared to React. Importing child components and getting used to signal() and effect() took a minute to wrap my head around.

- **Faker & Seeders**: Having built-in seeders in Laravel was awesome. In Spring Boot, I usually populated dummy data manually or via SQL scripts, so using Faker to quickly generate realistic stories, categories, and authors was super handy.

## Known Limitations / Future Work

- **Pagination**: currently returns a fixed page of results; currently only have 25 news in a page, so extending this to full pagination controls (page numbers, page size configuration).
- **Deployment**: currently runs locally. Next step is deploying the Laravel API to Railway or Render, and the Angular frontend to Vercel.
