# Padmashree | User Management System

A simple PHP-based user management web application built for **EC3352** coursework. The project includes registration, login, password reset, and user listing with client-side validation.

## Live Demo

**URL:** [gajendra.freedev.app](https://gajendra.freedev.app)

## Features

- User Registration
- User Login
- Forgot Password
- View All Users (with DataTables integration)
- Client-side form validation
- PHP backend support

## Tech Stack

| Technology | Purpose |
|------------|---------|
| HTML5 | Page structure |
| CSS3 | Styling |
| JavaScript (Vanilla) | Client-side validation |
| PHP | Backend processing |
| jQuery | DOM manipulation & DataTables |
| DataTables | Table enhancement |
| FiveServer | Development server with PHP |

## Database

**Database Name:** `db_dynamic`  
**Table Name:** `users`

### Schema

```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(250) NOT NULL,
    agree BOOLEAN NULL DEFAULT TRUE,
    status BOOLEAN NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL
);
```

## Project Structure

```
padmashree/
├── index.html              # Landing / Home page
├── login.html              # Login form
├── register.html           # Registration form
├── forgot-password.html    # Password reset form
├── list.html               # Display all users
├── index1.php              # PHP test file
├── script.js               # Client-side form validation
├── style.css               # Global styles
├── fiveserver.config.js    # FiveServer configuration
└── README.md               # Project documentation
```

## Page Overview

| File | Description |
|------|-------------|
| `index.html` | Welcome page with navigation to Login, Register, and View All Users |
| `login.html` | Sign-in form with username/email and password fields |
| `register.html` | Sign-up form with full name, email, username, password, and terms agreement |
| `forgot-password.html` | Email-based password reset request form |
| `list.html` | DataTables-powered user list with Edit and Delete actions |

## Getting Started

### Prerequisites

- PHP 8.x
- MySQL / MariaDB
- A modern web browser

### Setup

1. Clone or download the repository:
   ```bash
   git clone <repository-url>
   cd padmashree
   ```

2. Import the database schema into MySQL:
   ```bash
   mysql -u root -p < schema.sql
   ```

3. Start the development server (FiveServer recommended):
   ```bash
   # Open the project folder in VS Code and start FiveServer
   ```

   Or use PHP's built-in server:
   ```bash
   php -S localhost:8000
   ```

4. Open the browser and navigate to:
   ```
   http://localhost:8000
   ```

## Client-side Validation

`script.js` provides real-time validation for all forms:
- **Required fields:** Username, Password, Full Name, E-mail
- **Email format:** Regex-based validation on keyup
- **Confirm Password:** Mandatory field check
- **Terms Agreement:** Must be checked before submission

Errors are displayed inline below each field.

## Notes

- `list.html` currently contains static/demo data. Backend integration with the `users` table is required for dynamic data.
- `edit.html`, `delete.php`, `logout.php`, and `login.php` are referenced but not yet implemented.
- Password hashing and server-side authentication logic are not yet implemented.
