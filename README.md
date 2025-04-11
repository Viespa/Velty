# Velty ⚡ - Modern PHP Microframework

**Velty** is a custom-built PHP microframework focused on clarity, speed, and a modern developer experience.  
It features routing, dynamic views, middleware, and a Laravel-Ignition-style debug system.

## 🚀 Current Features

- ✅ Full routing system (GET, POST, groups, middleware, named routes)
- ✅ Secure middleware with interface validation
- ✅ Dynamic views using `{{ variables }}`
- ✅ Visual debug system (stack trace, code preview, suggestions)
- ✅ Custom exceptions (`ViewNotFoundException`, etc.)
- ✅ Modern 404 error page
- ✅ PSR-4 autoloading (via Composer)
- ✅ `.env` support with `APP_DEBUG` toggle

## 📁 Basic Structure

```
Velty/
├── app/
├── core/
│   └── Router.php
│   └── View.php
├── public/
│   └── index.php
├── resources/
│   └── views/
│       └── welcome.php
│       └── errors/404.php
├── routes/
│   └── web.php
├── src/Exceptions/
│   └── ViewNotFoundException.php
├── .env
├── composer.json
```

## ⚙️ Requirements

- PHP 8.1+
- Composer

## 📦 Installation

```bash
git clone https://github.com/yourusername/velty.git
cd velty
composer install
```

## ▶️ Run

```bash
php velty run
```

## 📌 Coming Soon

- Built-in CLI: `php velty make:controller`, `init`
- Controller@method routing support
- Blade-style template system (`@include`, `@extends`)
- Basic authentication system
- Integrated testing framework

---

Crafted with ❤️ by Viespa.
