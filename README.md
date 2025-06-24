# 🔧 SynchroDiffusion — Symfony Backend API

This project is the backend of **SynchroDiffusion**, an application for vehicle product compatibility and selection, built with **Symfony 6+** and designed to work seamlessly with a **React Native (Expo)** frontend.

---

## 🚀 Getting Started

### 🔧 Requirements

- PHP >= 8.1
- Composer
- MySQL or MariaDB
- Symfony CLI (recommended)

---

## 📦 Installation

```bash
git clone https://github.com/your-username/synchrodiffusion.git
cd synchrodiffusion
composer install
```

---

## ⚙️ Environment Setup

Create a local environment file:

```bash
cp .env.dev .env.local
```

Edit `.env.local` with your own values:

```env
APP_SECRET=your_secret_here
DATABASE_URL="mysql://root:password@127.0.0.1:3306/synchrodiffusion?serverVersion=8.0"
```

---

## 🧱 Database

### Create and migrate:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Load fixtures (mocked data):

```bash
php bin/console doctrine:fixtures:load
```

---

## 🧪 API Testing

API documentation is automatically available at:

```
http://localhost:8000/api/
```

---
