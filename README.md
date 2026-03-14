# Secure CRUD Engine

A lightweight, high-performance PHP MySQLi wrapper designed for security and modularity. This engine simplifies database interactions while enforcing best practices like **Singleton connections**, **Environment-based configurations**, and **Prepared Statements** to eliminate SQL injection risks.

## 🚀 Key Features

* **Singleton Pattern:** Ensures only one database connection is active per request, saving system resources.
* **Environment Security:** Seamlessly integrates with `vlucas/phpdotenv` to keep your credentials out of the source code.
* **Clean CRUD Logic:** Separates Read (`search`) and Write (`iud`) operations into simple, reusable methods.
* **Robust Error Handling:** Built-in connection failure checks and exception handling for failed queries.
* **Type-Safe Queries:** Uses prepared statements with explicit parameter binding.

## 📂 Project Structure

```text
project-root/
│
├── config/
│   ├── Env.php             # Dotenv loader wrapper
│   └── db_config.php       # Database parameter mapping
│
├── src/
│   └── Database.php        # Core CRUD Engine class
│
├── .env                    # Private credentials (DO NOT UPLOAD)
├── .gitignore              # Prevents sensitive files from being tracked
└── composer.json           # Dependencies (phpdotenv)
