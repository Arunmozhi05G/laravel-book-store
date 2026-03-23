# Laravel Book Store

A seamless Laravel web application for discovering and managing books. This project integrates the **Google Books API** and comes with custom setup scripts to make getting started as easy as possible!

## Tech Stack
- **Backend:** Laravel ^12.0 (PHP ^8.2)
- **Frontend:** TailwindCSS ^4.0, Vite
- **Database:** SQLite (default)

---

## 🚀 Easy Setup Guide

This project includes custom pre-configured `composer` scripts that automate the entire setup process. 

### Prerequisites
Make sure you have the following installed on your machine:
- **PHP** (v8.2 or higher)
- **Composer**

### 1. Clone the Repository
```bash
git clone <your-repo-url>
cd laravel-book-store
```

### 2. Run the Automated Setup
Instead of running setup commands one by one, simply run this single command:

```bash
composer setup
```

**What this does automatically:**
- Installs all PHP dependencies (`composer install`)
- Copies `.env.example` to `.env`
- Generates your application key
- Runs database migrations (`php artisan migrate --force`)

### 3. Configure API Keys
The project uses the Google Books API. Open your newly created `.env` file and add your API key near the bottom:

```env
GOOGLE_BOOK_API_KEY=your_api_key_here
```

*(You can get a free API key from the [Google Cloud Console](https://console.cloud.google.com/)).*

### 4. Start the Development Server
To start the project, use our custom dev command which runs the Laravel server, Vite, and the Queue listener concurrently:

```bash
composer dev
```

Your application should now be accessible at [http://localhost:8000](http://localhost:8000).

---

## 📜 Available Custom Scripts

You can run these scripts using `composer <script-name>`:

| Command | Description |
|---|---|
| `composer setup` | Complete project initialization (dependencies, key, DB, frontend build). |
| `composer dev` | **Concurrently** runs `php artisan serve`, `php artisan queue:listen`, and `npm run dev` to start all necessary services for development. |
| `composer test` | Clears config cache and runs Pest tests. |
