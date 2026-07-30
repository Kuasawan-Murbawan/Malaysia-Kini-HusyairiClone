# Malaysiakini-style News Portal

A full-stack news portal built as a skill assessment for AppAsia Berhad, demonstrating backend API development in Laravel and frontend consumption in Angular. The design is inspired by [Malaysiakini's news listing page](https://www.malaysiakini.com/my/latest/news).

## Tech Stack

**Backend:** Laravel, MySQL, Eloquent ORM
**Frontend:** Angular (v22), TypeScript, RxJS, Signals

## Features

- REST API exposing news stories, categories, and comments as JSON
- Relational data model: stories belong to a category, optionally have an author, have many tags (many-to-many), and have many comments
- Category-based filtering via query parameter (`GET /api/news?category={slug}`)
- Responsive news listing page with a slide-out category menu, styled to resemble the Malaysiakini layout
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

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/news` | Paginated list of stories, optional `?category={slug}` filter |
| GET | `/api/news/{id}` | Full details of a single story |
| GET | `/api/categories` | List of all categories |
| GET | `/api/categories/{id}` | Single category |
| GET | `/api/comments/{id}` | Single comment |
| GET | `/api/news/{id}/comments` | Comments for a story |

## What I Learned

This was my first project in Laravel and Angular, coming from a Java Spring Boot / React background. A few things that stood out:

- **Eloquent relationships** map closely to JPA relationships conceptually, but the migration + model + resource layering in Laravel made the data flow (schema → relationship → serialization) very explicit, which helped me reason clearly about the many-to-many tags relationship and the pivot table it requires.
- **Laravel API Resources** were a clean way to decouple the database shape from the API's JSON shape — similar in spirit to a DTO layer, but more lightweight.
- **Angular's standalone components and signals** were the biggest shift from React. Explicitly declaring each child component in a parent's `imports` array, and using `signal()`/`effect()` for reactive state instead of plain class properties, took some adjustment, but it made data flow between sibling components (the category sidebar and the news listing) much clearer once I understood the pattern.
- **Faker/seeders** were a new concept to me (no direct equivalent in how I'd seeded Spring Boot projects before), and a good forcing function to think about realistic dummy data instead of placeholder text everywhere.

## Known Limitations / Future Work

- **Pagination**: currently returns a fixed page of results; extending this to full pagination controls (page numbers, page size configuration) is a natural next step.
- **Comment submission**: the API currently only supports reading comments; a `POST /api/news/{id}/comments` endpoint would allow users to actually submit comments from the app.
- **Deployment**: currently runs locally. Next step is deploying the Laravel API to Railway or Render, and the Angular frontend to Vercel, with environment-based API URL configuration.
- **Search and language switching**: the navbar includes placeholder UI for these (matching the reference design) but they are not functional, as they were outside the scope of this assessment.
