# Laravel API Project

## 📌 Overview
This project is a Laravel-based RESTful API built to learn and practice API development using Laravel. It includes features such as:
- API Routing
- Category Management (using Collections & Resources)
- Authentication with Laravel Sanctum
- Localization Support

---

## 🚀 Installation

### **1️⃣ Clone the Repository**
```sh
 git clone <your-repository-url>
 cd <project-folder>
```

### **2️⃣ Install Dependencies**
```sh
composer install
```

### **3️⃣ Configure Environment**
Copy the example environment file and generate an application key:
```sh
cp .env.example .env
php artisan key:generate
```

Set up your database credentials in `.env`:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### **4️⃣ Run Migrations**
```sh
php artisan migrate
```

### **5️⃣ Serve the Application**
```sh
php artisan serve
```

Your API will be available at: `http://127.0.0.1:8000`

---

## 📌 API Features

### 🔹 Authentication (Sanctum)
This project uses Laravel Sanctum for API authentication. To enable it, publish the Sanctum configuration:
```sh
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```
Run the migration:
```sh
php artisan migrate
```
Add Sanctum middleware in `app/Http/Kernel.php`:
```php
'api' => [
    \Illuminate\Auth\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```
Ensure `config/sanctum.php` has:
```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost,127.0.0.1')),
```

### 🔹 Routes & Endpoints
All API routes are defined in `routes/api.php`.

#### **Authentication Routes**
```php
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
```

#### **Category Routes**
```php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'delete']);
});
```

### 🔹 Collections & Resources
This project uses **API Resources** for structuring API responses.

#### **Example: `CategoriesResource.php`**
```php
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'slug' => $this->slug,
        'is_active' => (bool) $this->is_active,
    ];
}
```

---

## 🔥 Testing the API

Use **Postman** or **cURL** to test your endpoints.

### **Login Request (POST `/api/login`)**
```json
{
    "email": "user@example.com",
    "password": "password"
}
```
### **Create Category (POST `/api/categories`)**
```json
{
    "name": "New Category",
    "slug": "new-category",
    "is_active": 1
}
```

---

## 📜 License
This project is licensed under the **MIT License**.

---

## 📧 Contact
For questions or contributions, reach out to [Samuel Khalaf] at [samuel.khalaf.official].

