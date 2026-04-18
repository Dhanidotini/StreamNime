# StreamNime

Website for streaming anime

## Project details
- Laravel v12
- Filament v4
- Horizon
- S3 Support (Only MiniO).
- Redis
- MariaDB/MySQL

## Features
- Image upload s3 (Poster & Banners).
- Episode related Anime.
- Genre, studios.
- User permission.

## Run Locally

Clone the project

```bash
  git clone https://github.com/Dhanidotini/StreamNime
```

Go to the project directory

```bash
  cd StreamNime
```

Install dependencies

```bash
  composer install
  pnpm install
```

Set environment
```bash
  cp .env.example .env 
```

Start the server

```bash
  composer run dev
```

