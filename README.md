# Malaysiakini-style News Portal

A full-stack news portal built as a skill assessment for AppAsia Berhad, demonstrating backend API development in Laravel and frontend in Angular. The design is inspired by [Malaysiakini's news listing page](https://www.malaysiakini.com/my/latest/news).

- Notion page for what i've learned from this assessment -> [Husyairi-Kini Learn](https://app.notion.com/p/Malaysiakini-News-Portal-Clone-3abff1b725488058859bd2ed796cc388?source=copy_link).

## Live Demo

- Frontend: https://malaysia-kini-husyairi-clone-murex.vercel.app/
- Backend API: https://malaysia-kini-husyairiclone-production.up.railway.app/api

### API Testing via Postman

The backend API is live on Railway and ready to test without any local environment setup:

- **Live Base URL:** `https://malaysia-kini-husyairiclone-production.up.railway.app/api`
- **Postman Collection:** [Download / Import `mkini.postman_collection.json`](./mkini.postman_collection.json)

#### How to import into Postman:
1. Download `mkini.postman_collection.json` from this repo.
2. Open Postman $\rightarrow$ Click **Import** (top left).
3. Drag & drop the file into Postman to load all 6 pre-configured requests.

## Tech Stack

**Backend:** Laravel, MySQL, Eloquent ORM

**Frontend:** Angular (v22), TypeScript, RxJS, Signals

**Deployment & Hosting:** Railway (Backend API & Database), Vercel (Frontend SPA)

**API Testing:** Postman

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
### Database Schema
<img width="932" height="372" alt="mkini-schema drawio" src="https://github.com/user-attachments/assets/5c0a76f1-071c-4189-b817-e62b3265caf6" />


## Setup Instructions

### Prerequisites

- PHP 8.2+ and Composer
- Node.js 20+ and npm
- MySQL (running locally, with a database created for this project)

### Database (MySQL)

Before running migrations, create an empty MySQL database (e.g. `mkini_portal`):

```bash
mysql -u root -p -e "CREATE DATABASE mkini_portal;"
```



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

- **API Resources**: I loved using Laravel API Resources. It’s basically an easier way to make DTOs without the heavy template, keeping the database structure separate from what the frontend actually receives.

- **Angular's Signals & Standalone Components**: This was definitely the biggest change compared to React. Importing child components and getting used to signal() and effect() took a minute to wrap my head around.

- **Faker & Seeders**: Having built-in seeders in Laravel was awesome. In Spring Boot, I usually populated dummy data manually or via SQL scripts, so using Faker to quickly generate realistic stories, categories, and authors was super handy.

## Known Limitations / Future Work

- **Pagination**: currently returns a fixed page of results; currently only have 25 news in a page, so extending this to full pagination controls (page numbers, page size configuration).

## A Note on AI Assistance

I used Claude (Anthropic) throughout this project, primarily as a learning aid since 
this was my first time working with Laravel and Angular as my prior experience is with 
Java Spring Boot and React. I used it to understand framework-specific concepts (Eloquent 
relationships, Angular's signal-based reactivity, standalone components), get feedback on 
my schema and code as I wrote it, and debug issues as they came up.

All architectural decisions (data model, relationships, API design, scope trade-offs like 
skipping pagination) were mine, and I can walk through and explain any part of the codebase 
in detail.
