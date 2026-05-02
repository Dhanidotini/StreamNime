# StreamNime

A self-hosted anime streaming platform built with Laravel 12. Manage your anime catalog, upload episodes, and provide a streaming experience for your users.

## Features

### For Viewers
- **Home Page** — Browse trending, currently airing, completed, and popular anime
- **Anime Detail Page** — View synopsis, genres, studio info, rating, and episode list
- **Episode Streaming** — Watch episodes with previous/next navigation
- **Anime List** — Full catalog with advanced filtering:
  - Search by title or synopsis
  - Filter by status (Airing / Completed)
  - Filter by type (TV, Movie, OVA, ONA, Music)
  - Filter by genre (multi-select)
  - Filter by release year range
  - Sort by title, rating, or latest
- **Responsive Design** — Works on desktop and mobile browsers

### For Administrators (Filament Dashboard)
- **Anime Management** — Create, edit, and delete anime entries with posters & banners
- **Episode Management** — Add episodes with video URLs, release dates, and thumbnails
- **Genre Management** — Organize anime by genre categories
- **Studio Management** — Track animation studios
- **User & Role Management** — Control access with role-based permissions (via Filament Shield)
- **Media Library** — Upload and manage images stored on local disk or MinIO (S3)
- **Queue Monitoring** — Monitor background jobs with Laravel Horizon

## Tech Stack

| Component | Technology |
|-----------|------------|
| Backend | Laravel 12 (PHP 8.4+) |
| Admin Panel | Filament v4 |
| Frontend | Livewire 3 + Tailwind CSS 4 + Vite |
| Database | MariaDB / MySQL |
| Cache & Queue | Redis |
| Queue Dashboard | Laravel Horizon |
| Object Storage | MinIO (S3-compatible) |
| Application Server | FrankenPHP via Laravel Octane |
| Testing | Pest |

## Installation

### Prerequisites

- PHP 8.4+
- Composer
- Node.js 25+ / pnpm 10+
- MariaDB or MySQL
- Redis

### Steps

1. **Clone and install**
   ```bash
   git clone https://github.com/Dhanidotini/StreamNime.git
   cd StreamNime
   composer install
   pnpm install
   ```

2. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit `.env` and set your database, Redis, and storage credentials.

3. **Run migrations**
   ```bash
   php artisan migrate
   ```

4. **Create admin user**
   ```bash
   php artisan make:filament-user
   ```

5. **Build frontend assets**
   ```bash
   pnpm build
   ```

6. **Start the development server**
   ```bash
   composer run dev
   ```

   This concurrently starts the server, queue listener, log tail, and Vite dev server.

## Configuration

### Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `APP_NAME` | Site name | StreamNime |
| `APP_URL` | Base URL | `http://localhost:8080` |
| `VIDEO_PREFIX` | Prefix prepended to episode video URLs | (empty) |
| `DB_CONNECTION` | Database driver | `mariadb` |
| `DB_HOST` | Database host | `127.0.0.1` |
| `DB_DATABASE` | Database name | `streamnim` |
| `REDIS_HOST` | Redis host | `redis` |
| `AWS_ACCESS_KEY_ID` | MinIO/S3 access key | — |
| `AWS_SECRET_ACCESS_KEY` | MinIO/S3 secret key | — |
| `AWS_URL` | MinIO/S3 endpoint URL | — |
| `AWS_BUCKET` | Bucket name | — |
| `FILESYSTEM_DISK` | Storage driver (`public` or `s3`) | `public` |

### Switching to S3/MinIO Storage

1. In `.env`, set:
   ```env
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=your-key
   AWS_SECRET_ACCESS_KEY=your-secret
   AWS_URL=http://localhost:9000
   AWS_ENDPOINT=http://localhost:9000
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=streamnime
   AWS_USE_PATH_STYLE_ENDPOINT=true
   ```

2. Restart the application.

## Project Structure

```
StreamNime/
├── app/
│   ├── Filament/          # Admin panel resources (CRUD pages)
│   ├── Livewire/          # Frontend page components
│   │   ├── Layouts/       # Shared layout parts (navbar, footer, search)
│   │   └── Pages/         # Public-facing pages
│   ├── Models/            # Eloquent models
│   ├── Services/          # Service classes
│   └── Traits/            # Shared traits (caching, scopes)
├── database/
│   ├── migrations/        # Database schema
│   └── seeders/           # Seed data
├── resources/
│   └── views/             # Blade templates
├── routes/
│   └── web.php            # Web routes
└── storage/
    ├── media-library/     # Uploaded media files
    └── logs/              # Application logs
```

## Available Routes

| URL | Description |
|-----|-------------|
| `/` | Home page with trending, airing, completed, and popular anime |
| `/anime-list` | Full anime catalog with search and filters |
| `/animes/{slug}` | Anime detail page with info and episode list |
| `/animes/{slug}/episode/{number}` | Episode streaming page |
| `/admin` | Filament admin dashboard |
| `/horizon` | Laravel Horizon queue monitor |

## Setup Super-Admin

After creating a Filament user, run the following commands to grant super-admin privileges and generate all Shield policies and permissions:

```bash
# Create a Filament user first
php artisan make:filament-user

# Make the user a super-admin (replace with your user ID or email)
php artisan shield:super-admin --user=1

# Generate all Shield policies and permissions
php artisan shield:generate --all
```

This assigns the `super_admin` role with full permissions across all Filament resources.

## Common Commands

```bash
# Start all services (dev)
composer run dev

# Run migrations
php artisan migrate

# Clear all caches
php artisan optimize:clear

# Queue worker
php artisan queue:work

# Run tests
composer run test

# Format code
./vendor/bin/pint
```

## License

MIT
