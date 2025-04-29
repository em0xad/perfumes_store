# Simple Perfume Store - PHP Project

This is a simple online perfume store developed as part of Homework 3 for the PHP course with midad.

---

## Project Description
- Users can register, log in, and log out.
- Admins can manage users (add, edit, delete).
- Registered users can manage products (add, edit, delete).
- Visitors can browse the product list.
- Each product includes a name, price, description, and an image.

---

## Technologies Used
- PHP (Server Side)
- MySQL (Database)
- HTML & CSS
- Bootstrap (for UI design)
- Basic input validation

---

## Installation Instructions

1. Clone the project or download the ZIP file.

2. Set up the Database:
   - Open XAMPP and start Apache and MySQL.
   - Go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Create a new database named perfume_store.
   - Import the SQL file located at /database/perfume_store.sql.

3. Configure the connection:
   - Check the db_connection.php file to ensure it matches your local settings:
     - Host: localhost
     - User: root
     - Password: (empty)
     - Database: perfume_store

4. Run the project:
   - Place the project folder inside the htdocs folder.
   - Access the site at:  
     http://localhost/perfume_store/

---

## Default Login Information
- Admin Email: admin@example.com
- Password: 123456
  
*(You can modify users or create new ones directly from the system.)*

---

## Notes
- Passwords are securely hashed using password_hash().
- Basic input validation is implemented for registration and login.
- Admin pages are protected and accessible only to admin users.
- Project built and tested locally on XAMPP.

---
## Developer
Emad Aladl