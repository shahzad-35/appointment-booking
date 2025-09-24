# 🗓️ Appointment Booking System

A **Laravel 12-based appointment booking system** designed for managing appointments for consultants, doctors, salons, and other service providers.

---

## 🌟 Features

* Browse and book available services and slots.
* Cancel or reschedule appointments.
* Receive email/SMS notifications.
* Manage profile (update phone, upload picture).
* Service providers can manage slots and view bookings.

---

## 🛠️ Technologies

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge\&logo=php\&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-0ACF83?style=for-the-badge\&logo=laravel\&logoColor=white)
![Blade Heroicons](https://img.shields.io/badge/Blade_Heroicons-101010?style=for-the-badge\&logo=icons8\&logoColor=white)
![Laravel Breeze](https://img.shields.io/badge/Breeze-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)

---

## ⚙️ Setup

```bash
git clone https://github.com/shahzad-35/appointment-booking.git
cd appointment-booking
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Visit `http://localhost:8000`.

---

## 💡 Improvements

* Real-time updates with Livewire.
* Payment integration.
* Analytics dashboard.
* Multi-language support.
* PWA support.
