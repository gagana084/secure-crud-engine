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
```
🛠️ Installation & Setup
Clone the repository:

```text
git clone [https://github.com/your-username/secure-crud-engine.git](https://github.com/your-username/secure-crud-engine.git)
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
📖 Usage Guide
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
🔒 Security Best Practices
Environment Protection: Never commit your .env file. It is already added to .gitignore to prevent leaking passwords.

SQL Injection Prevention: Always pass variables through the $params array. Never concatenate variables directly into the query string.

Minimalist Footprint: The engine uses a single static connection to prevent database "Too many connections" errors.

📜 License
Distributed under the MIT License. See LICENSE for more information.

Developed with ❤️ for secure web development.
