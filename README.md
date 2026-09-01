# Padmashree | User Management System

A PHP-based user management web application built for **EC3352** coursework. Supports registration, login, password reset, and user listing with environment-aware database configuration (local dev vs remote production).

## Live Demo

**URL:** [https://dynamic.gajendramahato.com.np](https://dynamic.gajendramahato.com.np)

## Features

- User Registration with server-side persistence
- User Login
- Forgot Password
- View All Users (with DataTables integration)
- Client-side form validation (JavaScript)
- Environment-aware database configuration (local/remote auto-switch)
- Automated deployment to InfinityFree via GitHub Actions

## Tech Stack

| Technology | Purpose |
|------------|---------|
| PHP 8.x | Server-side logic |
| MySQL / MariaDB | Database |
| HTML5 | Page structure |
| CSS3 | Styling |
| JavaScript (Vanilla) | Client-side validation |
| jQuery + DataTables | User list table |
| XAMPP/LAMPP | Local development stack |
| FiveServer | VS Code dev server with PHP |
| GitHub Actions | CI/CD deployment |
| InfinityFree | Production hosting |

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
├── .github/
│   └── workflows/
│       └── deploy.yml         # GitHub Actions: FTP deploy to InfinityFree
├── .gitignore                 # Excludes db_config.php from VCS
├── index.php                  # Landing / Home page
├── login.php                  # Login form
├── register.php               # Registration form (handles INSERT)
├── forgot-password.php        # Password reset form
├── list.php                   # Display all users
├── db_config.php              # Environment-aware DB config (gitignored)
├── script.js                  # Client-side form validation
├── style.css                  # Global styles
├── fiveserver.config.js       # FiveServer config (excluded from deploy)
└── README.md                  # Project documentation
```

## Environment Configuration

`db_config.php` automatically detects the runtime environment:

| Environment | Trigger | Database |
|-------------|---------|----------|
| **Local** | hostname = `arch`, CLI mode, or `localhost` | `localhost` / `root` / `db_dynamic` |
| **Remote** | Production (InfinityFree) | `sql113.infinityfree.com` / `if0_42795368_db_dynamic` |

> `db_config.php` is **gitignored** — credentials are never pushed to GitHub. Each developer/environment maintains their own version.

## Local Setup

### Prerequisites

- **XAMPP/LAMPP** (provides PHP + MySQL)
- MySQL/MariaDB running locally
- VS Code with FiveServer extension (optional)

### Steps

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd padmashree
   ```

2. Create `db_config.php` in the project root (since it's gitignored):
   ```php
   <?php
   if (gethostname() === 'arch' || PHP_SAPI === 'cli' || str_contains($_SERVER['HTTP_HOST'] ?? '', 'localhost')) {
       define('DB_HOST', 'localhost');
       define('DB_USER', 'root');
       define('DB_PASS', '');
       define('DB_NAME', 'db_dynamic');
   } else {
       define('DB_HOST', 'sql113.infinityfree.com');
       define('DB_USER', 'if0_42795368');
       define('DB_PASS', 'your_password');
       define('DB_NAME', 'if0_42795368_db_dynamic');
   }
   $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
   ?>
   ```

3. Start XAMPP services (Apache + MySQL).

4. Create the database and table using the schema above.

5. Point FiveServer to your XAMPP PHP:
   ```js
   // fiveserver.config.js
   module.exports = {
     php: "/opt/lampp/bin/php"
   }
   ```

6. Open the project in VS Code and start FiveServer.

## Production Deployment

Deployment is automated via **GitHub Actions** (`.github/workflows/deploy.yml`):

- Triggers on every push to `master`
- Uses FTP to deploy to InfinityFree's `htdocs/` directory
- Excludes `.git`, `README.md`, and `fiveserver.config.js`

### Required GitHub Secrets

Configure these in **Settings → Secrets and variables → Actions**:

| Secret | Description |
|--------|-------------|
| `FTP_SERVER` | InfinityFree FTP hostname |
| `FTP_USERNAME` | FTP username |
| `FTP_PASSWORD` | FTP password |

## Client-side Validation

`script.js` provides inline validation for all forms:
- Required fields: Username, Password, Full Name, E-Mail
- Email format validation (regex) on keyup
- Confirm Password required
- Terms agreement required before submission

## Current Implementation Status

| Page | Status |
|------|--------|
| `index.php` | Done — landing page |
| `register.php` | Done — inserts user into DB |
| `login.php` | UI done — auth logic not yet implemented |
| `forgot-password.php` | UI done — reset logic not yet implemented |
| `list.php` | UI only — uses hardcoded rows; needs DB query |
| `edit.php` | Not implemented |
| `delete.php` | Not implemented |
| `logout.php` | Not implemented |

## Security Notes

- `register.php` currently uses **string interpolation** for SQL — vulnerable to SQL injection. Migrate to **prepared statements** before production.
- Passwords are stored in plain text — use `password_hash()` / `password_verify()`.
- `db_config.php` is gitignored, but `db_config.php` may already be tracked if added before `.gitignore`. Remove it from git history if so: `git rm --cached db_config.php`.
