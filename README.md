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
│   
│
├── database/
│   └── connection.php        # Core CRUD Engine class
|   └── db_config.php       # Database parameter mapping
│
├── .env                  
├── .gitignore              
└── composer.json         
```
🛠️ Installation & Setup
Clone the repository:

```text
git clone https://github.com/gagana084/secure-crud-engine.git
```
Install Dependencies:
Ensure you have Composer installed, then run:
```text
composer install
```
Configure Environment Variables:
Create a .env file in your root directory:
```text
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_secure_password
DB_NAME=your_database_name
DB_PORT=3306
```
## 📖 Usage Guide

### 🛠️ Step 1: Include the Engine
Before using the database, you must include the necessary files at the top of your PHP script.

#### Option A: Using Composer Autoload (Recommended)
If you followed the installation steps and ran `composer install`, simply include the autoloader:
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/database/connection.php';
```
1. Fetching Data (Read)
The search() method returns a mysqli_result object.
```text
$query = "SELECT * FROM users WHERE status = ? AND city = ?";
$params = [1, 'Colombo'];
$types = "is"; // i = integer, s = string

$results = Database::search($query, $params, $types);

while ($row = $results->fetch_assoc()) {
    echo "User: " . $row['username'];
}
```
2. Insert, Update, Delete (Write)
The iud() method (Insert, Update, Delete) is used for any query that modifies data. It returns true on success.
```text
$query = "INSERT INTO logs (action, user_id) VALUES (?, ?)";
$params = ["User Login", 45];
$types = "si";

if (Database::iud($query, $params, $types)) {
    echo "Record updated successfully!";
}
```

## 🧩 Parameter & Data Types Reference

When using `search()` or `iud()`, you must provide the `$types` string. Each character in the string corresponds to the data type of the variables in the `$params` array.

| Character | Description | PHP/MySQL Data Type |
| :--- | :--- | :--- |
| **`i`** | **Integer** | Whole numbers (e.g., 1, 100, -5) |
| **`s`** | **String** | Text, Varchar, Dates (e.g., "Hello", "2026-03-14") |
| **`d`** | **Double** | Floating point numbers/Decimals (e.g., 19.99, 0.5) |
| **`b`** | **Blob** | Binary data (e.g., images, PDF files) |

### Example with multiple types:
If your query has an **email (string)**, an **age (integer)**, and a **rating (double)**:

```php
$query = "INSERT INTO survey (email, age, rating) VALUES (?, ?, ?)";
$params = ["user@example.com", 25, 4.5];
$types = "sid"; // s = string, i = integer, d = double

Database::iud($query, $params, $types);
```
🔒 Security Best Practices
Environment Protection: Never commit your .env file. It is already added to .gitignore to prevent leaking passwords.

SQL Injection Prevention: Always pass variables through the $params array. Never concatenate variables directly into the query string.

Minimalist Footprint: The engine uses a single static connection to prevent database "Too many connections" errors.

📜 License
Distributed under the MIT License. See LICENSE for more information.

Developed with ❤️ for secure web development.
