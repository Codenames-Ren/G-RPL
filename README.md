# G-RPL — Recognition of Prior Learning System

G-RPL is a web-based Recognition of Prior Learning (RPL) system built using Laravel and API-first architecture.
This system is designed to manage academic recognition workflows, including application submission, document verification, asesor assignment, and SKS/course conversion assessment.

---

# ✨ Features

## Authentication & Authorization

* Laravel Sanctum Authentication
* Role-Based Access Control (RBAC)
* Email Verification
* Rate Limiting Protection

## Applicant Features

* Create and manage RPL applications
* Upload required documents
* Add learning experiences
* Submit and update applications
* Cancel submitted applications

## Manager Features

* Review submitted applications
* Reject incomplete applications
* Assign asesor based on study program
* View assignment history

## Asesor Features

* Review assigned applications
* Approve or reject academic assessments
* Convert learning experiences into courses/SKS
* Reuse existing course mappings
* Create new course mappings inline

---

# 🏗️ Architecture

This project uses an **API-first architecture**.

* Backend handles:

  * Authentication
  * Business Logic
  * Validation
  * Database Operations
  * API Responses

* Frontend handles:

  * UI Rendering
  * API Consumption
  * State Management
  * User Interaction

Communication between frontend and backend is performed using REST API with JSON responses.

---

# 🛠️ Tech Stack

## Backend

* Laravel
* Laravel Sanctum
* MySQL
* Laravel Scramble (API Documentation)

## Frontend

* Blade
* Tailwind CSS
* Axios
* Alpine.js

---

# 🔐 Roles

| Role       | Responsibility                 |
| ---------- | ------------------------------ |
| Superadmin | Manage staff accounts          |
| Applicant  | Submit RPL application         |
| Manager    | Verify and assign applications |
| Asesor     | Perform academic assessment    |

---

# 📚 API Documentation

This project uses **Laravel Scramble** for API documentation.

Access API Docs:

```bash
http://localhost:8000/docs/api
```

---

# ⚙️ Installation

## Clone Repository

```bash
git clone https://github.com/Codenames-Ren/G-RPL.git
```

## Install Dependencies

```bash
composer install
npm install
```

## Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

## Configure Database

Edit `.env` file:

```env
DB_DATABASE=grpl
DB_USERNAME=root
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

---

# 🗄️ Run Migration

```bash
php artisan migrate
```

---

# 🚀 Run Application

## Backend

```bash
php artisan serve
```

## Frontend

```bash
npm run dev
```

---

# 👥 Contributors

| GitHub                                            | Role                       |
| ------------------------------------------------- | -------------------------- |
| [Codenames-Ren](https://github.com/Codenames-Ren) | Backend Developer          |
| [Rafreaks06](https://github.com/Rafreaks06)       | Frontend Developer         |
| [Diasmyri](https://github.com/Diasmyri)           | Frontend Developer & UI/UX |

---

# 📌 Notes

This project was developed as part of an academic software engineering project focusing on:

* API-first development
* RBAC implementation
* Academic workflow management
* RESTful API integration
* Team collaboration workflow

---

# 📄 License

This project is developed for educational purposes.
