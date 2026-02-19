<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## O projekcie

Aplikacja Laravel z architekturą **Domain-Driven Design (DDD)**. Logika biznesowa jest zorganizowana w domenach, co ułatwia skalowanie, utrzymanie i testowanie aplikacji.

## Stack technologiczny

| Warstwa | Technologia |
|---------|-------------|
| **Backend** | PHP 8.2+, Laravel 12 |
| **Frontend** | Vite 7, Tailwind CSS 4, Axios |
| **Baza danych** | Eloquent ORM (SQLite/MySQL/PostgreSQL) |
| **Testy** | PHPUnit 11 |
| **Narzędzia** | Laravel Pint, Laravel Sail, Laravel Boost |

## Domain-Driven Design (DDD)

**Domain-Driven Design** to podejście do projektowania oprogramowania, w którym nacisk kładzie się na modelowanie logiki biznesowej wokół **domen** – wyodrębnionych obszarów wiedzy specyficznych dla problemu, który rozwiązuje aplikacja.

### Kluczowe założenia DDD

- **Domena** – obszar biznesowy (np. Auth, User, Order). Każda domena zawiera własną logikę, modele i reguły.
- **Izolacja** – domeny są niezależne; zmiany w jednej nie powinny wymagać modyfikacji innych.
- **Ubiquitous Language** – wspólny język między programistami a ekspertami biznesowymi.
- **Bounded Context** – wyraźne granice kontekstu, w którym obowiązują określone reguły.

### Struktura domeny w projekcie

Każda domena zawiera:

- **Models** – encje i modele Eloquent specyficzne dla domeny
- **Controllers** – kontrolery obsługujące żądania HTTP
- **Requests** – Form Requesty do walidacji
- **Actions** – akcje biznesowe (Single Responsibility)

## Wprowadzone zmiany dla DDD

### 1. Struktura katalogów `app/Domains/`

Główny katalog logiki biznesowej został przeniesiony do `app/Domains/`. Utworzono domeny:

- **Auth** – autentykacja, logowanie, rejestracja
- **User** – zarządzanie użytkownikami

### 2. Namespace i autoloading

Mapowanie PSR-4 `App\` → `app/` w `composer.json` obsługuje klasy z domen:

- `App\Domains\Auth\Controllers\LoginController`
- `App\Domains\User\Models\User`
- `App\Domains\Auth\Actions\LoginUserAction`

### 3. Routing domenowy (`bootstrap/app.php`)

W `withRouting()` dodano callback `then`, który umożliwia ładowanie tras specyficznych dla domen. Obecnie jest pusty – gotowy do użycia po przeniesieniu tras z `routes/web.php` do domen.

### 4. Plik `routes/domains.php`

Utworzono placeholder dla tras domenowych. W przyszłości można tam dołączać pliki tras z poszczególnych domen:

```php
require base_path('app/Domains/Auth/routes.php');
require base_path('app/Domains/User/routes.php');
```

## Struktura projektu

```
laravel_ddd/
├── app/
│   ├── Domains/                    # Logika biznesowa (DDD)
│   │   ├── Auth/
│   │   │   ├── Actions/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   └── Requests/
│   │   └── User/
│   │       ├── Actions/
│   │       ├── Controllers/
│   │       ├── Models/
│   │       └── Requests/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Providers/
├── bootstrap/
│   └── app.php                     # Konfiguracja routingu z callback dla domen
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   └── views/
├── routes/
│   ├── web.php
│   ├── console.php
│   └── domains.php                 # Placeholder dla tras domenowych
├── storage/
├── tests/
└── vendor/
```

## Uruchomienie

```bash
# Instalacja zależności
composer install
npm install

# Konfiguracja
cp .env.example .env
php artisan key:generate

# Migracje
php artisan migrate

# Build frontendu
npm run build

# Serwer deweloperski
php artisan serve
# lub
composer run dev
```

## Testy

```bash
php artisan test
```

## Licencja

Projekt wykorzystuje framework Laravel, dostępny na licencji [MIT](https://opensource.org/licenses/MIT).
