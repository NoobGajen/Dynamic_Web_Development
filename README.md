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
├── .gitignore                 # Excludes db.php and sensitive files from VCS
├── .library/                  # Third-party libraries
│   ├── jquery-4.0.0.min.js    # jQuery library
│   ├── datatables.min.js      # DataTables plugin
│   └── datatables.min.css     # DataTables styling
├── index.php                  # Landing / Home page
├── login.php                  # Login form & authentication
├── register.php               # Registration form (handles user INSERT)
├── forgot-password.php        # Password reset form
├── list.php                   # Display all users with DataTables
├── edit.php                   # Edit user (in development)
├── delete.php                 # Delete user
├── logout.php                 # Session logout
├── db.php                     # Database connection (gitignored - create locally)
├── script.js                  # Client-side form validation
├── style.css                  # Global styles & responsive design
├── fiveserver.config.js       # FiveServer configuration for VS Code
└── README.md                  # Project documentation
```

## Environment Configuration

The `db.php` file contains database connection credentials and is **gitignored** for security. 

**For Local Development:**
- Host: `localhost`
- Username: `root` (XAMPP/LAMPP default)
- Password: `` (empty by default)
- Database: `db_dynamic`

**For Production (InfinityFree):**
- Update the credentials in your production server
- Use environment variables or a separate config file
- Never commit credentials to version control

> The credentials are identical for all localhost setups, so the provided `db.php` template can be used by any developer for local development.

## Local Setup

### Prerequisites

- **XAMPP/LAMPP** (provides PHP + MySQL)
- MySQL/MariaDB running locally
- VS Code with FiveServer extension (optional)

### Database Configuration (db.php)

Since `db.php` is **gitignored**, you need to create it locally. Create a file named `db.php` in the project root with the following localhost configuration:

```php
<?php
// db.php - Database connection configuration
// This file is gitignored to protect credentials

$servername = "localhost";
$username = "root";
$password = "";  // Default XAMPP/LAMPP password is empty
$database = "db_dynamic";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8");
?>
```

**Environment Variables:**
- **Host:** `localhost` (local machine)
- **Username:** `root` (default XAMPP/LAMPP user)
- **Password:** `` (empty by default)
- **Database:** `db_dynamic`

### Database Setup

1. Open **phpMyAdmin** (usually at `http://localhost/phpmyadmin`)
2. Create a new database named `db_dynamic`
3. Select the database and run the following SQL to create the `users` table:

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

### Steps

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd padmashree
   ```

2. Create `db.php` in the project root with the localhost configuration (see above)

3. Start your local server (XAMPP/LAMPP):
   ```bash
   # macOS/Linux
   sudo /opt/lampp/lampp start
   
   # Or use XAMPP Control Panel
   ```

4. Access the application:
   - **FiveServer:** Open VS Code and use the FiveServer extension
   - **Apache:** Navigate to `http://localhost/padmashree/` (if in htdocs)
   - **Direct PHP:** Use VS Code's built-in PHP server or FiveServer

5. Verify database connection:
   - Visit the application and try registering a user
   - If successful, check phpMyAdmin to confirm the user record was created

## FiveServer Configuration

The project includes a `fiveserver.config.js` file configured for **LAMPP/XAMPP**:

```javascript
module.exports = {
  php: "/opt/lampp/bin/php"              // macOS/Ubuntu
//   php: "C:\\xampp\\php\\php.exe"   // Windows
}
```

**To use FiveServer with VS Code:**
1. Install the **FiveServer** extension from the VS Code Marketplace
2. Right-click on `index.php` → **Open with FiveServer**
3. FiveServer will start a live development server on `http://localhost:5500`

## Troubleshooting

| Issue | Solution |
|-------|----------|
| **Database connection error** | Verify XAMPP/LAMPP is running; create `db.php` with correct credentials; ensure `db_dynamic` database exists |
| **Table not found** | Run the SQL schema from Database Setup section in phpMyAdmin |
| **FiveServer not working** | Check PHP path in `fiveserver.config.js`; ensure XAMPP/LAMPP bin directory exists |
| **Form validation not working** | Ensure `script.js` is loaded; check browser console for JavaScript errors |
| **DataTables not loading** | Verify jQuery and DataTables libraries are in `./.library/` folder |

## Security Notes

⚠️ **Important:**
- Never commit `db.php` (credentials) to version control
- Use `password_hash()` instead of SHA1 for password storage (currently using SHA1)
- Implement prepared statements to prevent SQL injection
- Sanitize all user inputs before database operations
- Use HTTPS in production

## Contributing

1. Create a feature branch: `git checkout -b feature/your-feature`
2. Commit changes: `git commit -m "Add feature description"`
3. Push to branch: `git push origin feature/your-feature`
4. Create a Pull Request

## License

This project is for **EC3352** coursework only.

## Support

For issues or questions, please open an issue on the GitHub repository.
