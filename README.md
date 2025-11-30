# ⚽ MySSL Web — Soegija Super League Fantasy

MySSL (My Soegija Super League) 2025/2026 is a **fantasy football league web application** where users can explore match information, club profiles, player statistics, league standings, and topscorers.  

The system includes multiple roles with specific permissions:

| Role | Permissions |
|------|-------------|
| **Public User** | View matches, clubs, players, statistics, standings |
| **Club Manager** | Manage lineups & add match stats for their club |
| **Admin** | Full access (manage users, clubs, matches, stats, league settings) |

This project is built using **Laravel 11**.

---

## 🚀 Features

### 👤 Authentication
- Register & Login
- Session-based user authentication
- Role-based access control (User / Club Manager / Admin)

### 📌 Public Features
- View match list & match details
- View club list & club details
- View player stats
- Topscorer table
- League standings (points, goals, etc.)

### 🏟 Club Manager Features
- Add / update match **lineups**
- Input **player performance stats** after matches

### 👑 Admin Features
- Manage users and roles
- Manage clubs and players
- Manage fixtures (match schedules)
- Manage standings calculations
- Full CRUD on all data

---

## 🛠️ Tech Stack

| Component | Technology |
|-----------|------------|
| Backend | Laravel 11 (PHP 8.2+) |
| Database | MySQL |
| Frontend | Blade & Tailwind CSS |

---

## 📂 Project Structure
app/
├─ Http/
│ ├─ Controllers/
│ ├─ Middleware/
├─ Models/
database/
├─ migrations/
├─ seeders/
public/
resources/
├─ views/
routes/
├─ web.php

---

## 🧪 Upcoming Enhancements (Roadmap)

- Player ratings
- Team of the week
- Player of the month & Coach of the month
- Team of the Season, Best Player, Best Goalkeeper, Best Coach
- Transfer windows for players (multiple seasons)
- Live match details & commentary

---

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/vinhartz06/IP2025-UAS.git
cd IP2025-UAS

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Set up database
# Create a MySQL database and update .env:
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=

# Run migrations and seeders
php artisan migrate --seed

# Start development server
php artisan serve