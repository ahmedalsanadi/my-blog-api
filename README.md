# 🌐 My Blog API

Welcome to **My Blog API**! This RESTful API is designed to help manage blog posts and user authentication using **JWT** (JSON Web Tokens) for secure access. Get started quickly with clear setup instructions, explore endpoints, and dive into the project structure below!

---

## 📜 Table of Contents
- [🚀 Technologies Used](#-technologies-used)
- [🛠️ Installation](#️-installation)
- [🧪 API Testing](#-api-testing)
- [📂 Project Structure](#-project-structure)
- [🗄️ Database](#️-database)
- [🤝 Contributing](#-contributing)
- [📜 License](#-license)

---

## 🚀 Technologies Used

This API utilizes a stack of powerful technologies to ensure smooth, reliable performance:

- **PHP**: Backend language for robust API functionality
- **Composer**: Dependency management
- **Firebase JWT**: Secure token-based authentication
- **PDO**: For efficient database interactions
- **Apache**: Web server for seamless hosting

---

## 🛠️ Installation

Set up the **My Blog API** in just a few steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/ahmedalsanadi/my-blog-api.git
   cd my-blog-api
   ```

2. **Install dependencies** (make sure you have [Composer](https://getcomposer.org/) installed):
   ```bash
   composer install
   ```

3. **Set up the database**:
   - Import `my_blog_api.sql` from the `database/` directory into your database:

     ```sql
     SOURCE database/my_blog_api.sql;
     ```

4. **Configure your environment**:
   - Update database connection settings in `config.php`.

---

## 🧪 API Testing

Test the API using tools like [Postman](https://www.postman.com/) or [cURL](https://curl.se/). Here’s a guide to the available endpoints:

### 🔑 User Endpoints
- **Register User**  
  **POST** `/my-blog-api/register`  
  **Request Body**:
  ```json
  {
    "username": "your_username",
    "password": "your_password"
  }
  ```

- **Login User**  
  **POST** `/my-blog-api/login`  
  **Request Body**:
  ```json
  {
    "username": "your_username",
    "password": "your_password"
  }
  ```

### ✍️ Blog Endpoints
- **Get All Posts**  
  **GET** `/my-blog-api/posts`

- **Get Post by ID**  
  **GET** `/my-blog-api/posts/{id}`

- **Create Post**  
  **POST** `/my-blog-api/posts`  
  **Request Body**:
  ```json
  {
    "title": "Post Title",
    "content": "Post Content"
  }
  ```

- **Update Post**  
  **PUT** `/my-blog-api/posts/{id}`  
  **Request Body**:
  ```json
  {
    "title": "Updated Title",
    "content": "Updated Content"
  }
  ```

- **Delete Post**  
  **DELETE** `/my-blog-api/posts/{id}`

> **Authentication**: For protected endpoints, include your JWT token in the `Authorization` header as a Bearer token.

---

## 📂 Project Structure

A quick overview of the directory structure for **My Blog API**:

```
my-blog-api/
├── controller/
│   ├── BlogController.php
│   └── UserController.php
├── database/
│   └── my_blog_api.sql
├── middleware/
│   └── AuthMiddleware.php
├── model/
│   ├── Blog.php
│   └── User.php
├── utils/
│   ├── RequestHelper.php
│   └── ResponseHelper.php
├── views/
│   └── response.php
├── Router.php
└── index.php

```

---

## 🗄️ Database

The database `my_blog_api.sql` file located in the project root includes the SQL schema required to set up the necessary tables for **My Blog API**. Import this file into your database to get started.

---

## 🔧 .htaccess Configuration

To enable URL rewriting and support Authorization headers, create or update the `.htaccess` file in your project directory with the following code:

```apache
RewriteEngine On
RewriteBase /my-blog-api/

# Enable Authorization header
SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1

# Your existing rules
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# CORS headers (if needed)
Header always set Access-Control-Allow-Origin "*"
Header always set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
Header always set Access-Control-Allow-Headers "Authorization, Content-Type"
```

This configuration enables URL rewriting for clean URLs, allows Authorization headers to be passed correctly, and includes optional CORS headers if needed for cross-origin access.

---

## 🤝 Contributing

Contributions are warmly welcomed! 🫱🏽‍🫲🏿 Whether it’s submitting a pull request, opening an issue, or discussing an improvement, every bit helps! 🚀

---

## 📜 License

This project is licensed under the **MIT License**. Check out the [LICENSE](LICENSE) file for details.

---

🌟 **Thank you for exploring My Blog API!** If you have any questions, feel free to reach out.