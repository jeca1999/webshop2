# Project Documentation

## Table of Contents

-   [Installation](#installation)
-   [Usage](#usage)
-   [Configuration](#configuration)
-   [Features](#features)
-   [Screenshots](#screenshots)
-   [FAQ](#faq)
-   [Contact](#contact)
-   [Project Structure](#project-structure)
-   [Database Schemas and ERD](#database-schemas-and-erd)

---

## Installation

1. **Clone the repository:**
    ```bash
    git clone <your-repo-url>
    cd <project-folder>
    ```
2. **Install dependencies:**
    ```bash
    composer install
    npm install
    ```
3. **Copy environment file:**
    ```bash
    cp .env.example .env
    ```
4. **Set up your environment variables** in `.env` (database, mail, etc).
5. **Generate application key:**
    ```bash
    php artisan key:generate
    ```
6. **Run migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```
7. **Build frontend assets:**
    ```bash
    npm run build
    ```
8. **Start the development server:**
    ```bash
    php artisan serve
    ```

---

## Usage

-   Visit `http://localhost:8000` in your browser.
-   Register or log in to access user features.
-   Browse products, add to cart, and checkout.
-   Use the dashboard for order management (if available).

---

## Configuration

-   Edit `.env` for database and mail settings.
-   See the `config/` directory for advanced options.
-   You may customize branding, images, and categories in the database or via the admin dashboard (if implemented).

---

## Features

-   Product browsing and search
-   Dynamic product modals with orientation detection
-   Cart and checkout
-   User authentication
-   Admin dashboard (if available)
-   Newsletter subscription
-   Support and policy links

---

## Screenshots

_Add screenshots or GIFs of your app here to showcase the UI and features._

---

## FAQ

**Q: How do I reset my password?**
A: Use the "Forgot Password" link on the login page.

**Q: How do I add new products?**
A: Log in as an admin and use the dashboard (if available), or add directly to the database.

---

## Contact

For support or questions, please contact the project maintainer at `<your-email@example.com>`.

---

## Project Structure

```
webshop2/
├── app/
│   ├── Actions/
│   │   └── Fortify/
│   │       ├── CreateNewUser.php
│   │       ├── PasswordValidationRules.php
│   │       ├── ResetUserPassword.php
│   │       ├── UpdateUserPassword.php
│   │       └── UpdateUserProfileInformation.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── ConfirmablePasswordController.php
│   │   │   │   ├── EmailVerificationNotificationController.php
│   │   │   │   ├── EmailVerificationPromptController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── PasswordController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   └── VerifyEmailController.php
│   │   │   ├── Controller.php
│   │   │   ├── MessageController.php
│   │   │   ├── OrderController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ProfileController.php
│   │   │   └── SellerProfileController.php
│   │   ├── kernel.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── RedirectBasedOnRole.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   └── trustproxies.php
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   └── LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── Message.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   ├── Seller.php
│   │   └── User.php
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   └── FortifyServiceProvider.php
│   └── View/
│       └── Components/
│           ├── AppLayout.php
│           └── GuestLayout.php
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2024_05_21_000000_create_sellers_table.php.php
│   │   ├── 2024_05_22_000000_create_products_table.php
│   │   ├── 2025_05_28_000000_create_messages_table.php
│   │   ├── 2025_06_01_050111_add_subcategory_to_products_table.php
│   │   ├── 2025_06_13_074206_add_is_approved_to_products_table.php
│   │   ├── 2025_06_13_095341_add_email_to_sellers_table.php
│   │   ├── 2025_06_13_104327_add_password_to_sellers_table.php
│   │   ├── 2025_06_13_104906_add_role_to_sellers_table.php
│   │   ├── 2025_06_16_000001_create_orders_table.php
│   │   ├── 2025_06_17_000002_create_order_items_table.php
│   │   ├── 2025_06_20_000001_create_orders_table.php
│   │   └── 2025_06_20_083123_add_two_factor_columns_to_users_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── SellerSeeder.php
├── public/
│   ├── image/
│   │   ├── 3ELLLE_home.jpg
│   │   ├── 3ELLLE_shop.jpg
│   │   ├── jenart_frtview.png
│   │   ├── jenart_gala.png
│   │   ├── jen_front view.jpg
│   │   ├── jen_gala.jpg
│   │   ├── rardsart_tayo.png
│   │   ├── rardsart_upo.png
│   │   ├── rards_nakatayo.jpg
│   │   └── rards_nakaupo.jpg
│   ├── js/
│   │   ├── products.js
│   │   └── seller-analytics.js
│   └── build/
│       ├── assets/
│       │   ├── app-Bf4POITK.js
│       │   └── app-DbTWgVAB.css
│       └── manifest.json
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── product.js
│   └── views/
│       ├── auth/
│       │   ├── confirm-password.blade.php
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── reset-password.blade.php
│       │   └── verify-email.blade.php
│       ├── cart.blade.php
│       ├── comission.blade.php
│       ├── components/
│       │   ├── auth-session-status.blade.php
│       │   ├── danger-button.blade.php
│       │   ├── dropdown-link.blade.php
│       │   ├── dropdown.blade.php
│       │   ├── input-error.blade.php
│       │   ├── input-label.blade.php
│       │   ├── modal.blade.php
│       │   ├── nav-link.blade.php
│       │   ├── primary-button.blade.php
│       │   ├── responsive-nav-link.blade.php
│       │   ├── secondary-button.blade.php
│       │   └── text-input.blade.php
│       ├── dashboard.blade.php
│       ├── find-order.blade.php
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── guest.blade.php
│       │   └── navigation.blade.php
│       ├── messages.blade.php
│       ├── orders.blade.php
│       ├── privacy-policy.blade.php
│       ├── products.blade.php
│       ├── profile/
│       │   ├── check-out.Blade.php
│       │   ├── edit.blade.php
│       │   └── partials/
│       │       ├── delete-user-form.blade.php
│       │       ├── order-history.blade.php
│       │       ├── place-order.blade.php
│       │       ├── two-factor-auth.blade.php
│       │       ├── update-password-form.blade.php
│       │       └── update-profile-information-form.blade.php
│       ├── prototype.blade.php
│       ├── returns-refunds.blade.php
│       ├── sellerdashboard.blade.php
│       ├── selleredit.blade.php
│       ├── shop.blade.php
│       ├── terms-of-service.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── auth.php
│   ├── console.php
│   └── web.php
├── storage/
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   │   ├── AuthenticationTest.php
│   │   │   ├── EmailVerificationTest.php
│   │   │   ├── PasswordConfirmationTest.php
│   │   │   ├── PasswordResetTest.php
│   │   │   ├── PasswordUpdateTest.php
│   │   │   └── RegistrationTest.php
│   │   ├── ExampleTest.php
│   │   └── ProfileTest.php
│   ├── Pest.php
│   ├── TestCase.php
│   └── Unit/
│       └── ExampleTest.php
├── vendor/
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── tailwind.config.js
├── vite.config.js
├── README.md
├── DOCUMENTATION.md
└── ...
```

---

## Database Schemas and ERD

### Main Tables

#### users

| Column   | Type    | Description           |
| -------- | ------- | --------------------- |
| id       | BIGINT  | Primary key           |
| name     | VARCHAR | User's name           |
| email    | VARCHAR | User's email (unique) |
| password | VARCHAR | Hashed password       |
| ...      | ...     | ...                   |

#### products

| Column      | Type    | Description                 |
| ----------- | ------- | --------------------------- |
| id          | BIGINT  | Primary key                 |
| name        | VARCHAR | Product name                |
| description | TEXT    | Product description         |
| price       | DECIMAL | Product price               |
| image       | VARCHAR | Image path                  |
| category    | VARCHAR | Category (e.g. shop)        |
| subcategory | VARCHAR | Subcategory (e.g. painting) |
| is_approved | BOOLEAN | Approval status             |
| ...         | ...     | ...                         |

#### orders

| Column  | Type    | Description          |
| ------- | ------- | -------------------- |
| id      | BIGINT  | Primary key          |
| user_id | BIGINT  | Foreign key to users |
| total   | DECIMAL | Order total          |
| status  | VARCHAR | Order status         |
| ...     | ...     | ...                  |

#### order_items

| Column     | Type    | Description             |
| ---------- | ------- | ----------------------- |
| id         | BIGINT  | Primary key             |
| order_id   | BIGINT  | Foreign key to orders   |
| product_id | BIGINT  | Foreign key to products |
| quantity   | INT     | Quantity ordered        |
| price      | DECIMAL | Price at order time     |
| ...        | ...     | ...                     |

#### sellers

| Column   | Type    | Description     |
| -------- | ------- | --------------- |
| id       | BIGINT  | Primary key     |
| name     | VARCHAR | Seller name     |
| email    | VARCHAR | Seller email    |
| password | VARCHAR | Seller password |
| role     | VARCHAR | Seller role     |
| ...      | ...     | ...             |

#### messages

| Column    | Type   | Description            |
| --------- | ------ | ---------------------- |
| id        | BIGINT | Primary key            |
| user_id   | BIGINT | Foreign key to users   |
| seller_id | BIGINT | Foreign key to sellers |
| content   | TEXT   | Message content        |
| ...       | ...    | ...                    |

### ERD (Entity Relationship Diagram)

![ERD Diagram](docs/erd.png)
