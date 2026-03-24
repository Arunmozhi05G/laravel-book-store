# 📚 Laravel Book Store

## 📌 Introduction

Laravel Book Store is a simple web application built using Laravel that allows users to browse and view books, while admin can manage books, categories, and users through a dedicated admin dashboard.

The application also integrates external APIs such as Google Books API to fetch additional book data and a Weather API to display location-based weather information on the home page.

---

## 🚀 Features

### 👤 User Features

* View list of books
* View book details
* Explore books from Google Books API
* View location-based weather on home page

### 🔐 Admin Features

* Admin dashboard
* Manage books (Create, Update, Delete)
* Manage categories
* View users list

---

## 🛠️ Tech Stack

* **Backend:** PHP 8.2, Laravel 12
* **Frontend:** Bootstrap 5.3
* **Database:** MySQL
* **APIs:** Google Books API, Weather API

---

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone <your-repo-link>
cd laravel-book-store
```

---

### 2. Setup Environment File

```bash
cp .env.example .env
```

Update your `.env` file with your database credentials:

```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

### 3. Check Requirements

Make sure your system has:

* **PHP >= 8.2**
* **Composer (latest version)**

Check versions:

```bash
php -v
composer -v
```

---

### 4. Install Dependencies

```bash
composer install
```

---

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

### 6. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

This will create:

* Admin account
* User account

---

### 7. Configure API Keys

Update your `.env` file:

```
GOOGLE_BOOK_API_KEY=your_google_books_api_key
```

---

### 8. Run the Application

```bash
php artisan serve
```

---

## 🔑 Default Credentials

### Admin

* Email: admin@example.com
* Password: Admin@123

### User

* Email: user@example.com
* Password: User@123

---

## 🌐 API Integration

* Google Books API is used to fetch and display additional books on the home page.
* Weather API is used to display location-based weather information.

---

## 📂 Project Highlights

* Clean MVC architecture
* Form Request validation
* Service-based API handling
* Separate layouts for Admin, User, and Auth
* Responsive UI using Bootstrap

---

## ✅ Notes

* Replace API keys in `.env` before running the project
* Ensure database is properly configured
* Use seeded credentials to access admin dashboard

---

## 📌 Author

Developed as part of Laravel Developer Interview Task.
