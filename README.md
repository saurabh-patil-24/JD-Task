JD Task - Core PHP

This is an assignment for JD, built using Core PHP. This repository contains the application code, SQL setup file, and necessary steps to run the project.

Table of Contents

Database Setup Running the Application Admin Setup Technologies Used

Database Setup

Import the SQL file: Download the project files and locate the db_structure.sql file in the root directory of the project. Open your MySQL database client (e.g., phpMyAdmin, MySQL Workbench) and run the SQL file to create the required tables.

If you're using phpMyAdmin: Log in to phpMyAdmin. Select or create a new database. Click on the "Import" tab and choose the db_structure.sql file. Click "Go" to execute the SQL commands and set up the database.

SQL File Contains: Database schema for tasks, users, admins, and their relationships.

Database Credentials: Edit the db_connection.php file to add your database credentials.

Running the Application

Start the Local Development Server: If you are using XAMPP or WAMP as your local development environment, start Apache and MySQL from the XAMPP/WAMP control panel. Navigate to the folder containing the project files (e.g., htdocs/JD-Task in XAMPP). 
Open your browser and visit http://localhost/JD-Task/.

Admin Setup

Once the database is set up, you need to create an admin user.

Create Admin User: After setting up the database, open your browser and navigate to the create_admin.php file in your project directory.

Example URL: http://localhost/your_project_directory/create_admin.php

Admin Login: After creating the admin, you will be provided with a link to the login page. Use the login credentials you just set up to log in as an admin.

Technologies Used

PHP: Core PHP for server-side logic. MySQL: For database management. Bootstrap: For styling the UI.

Additional Instructions

create_admin.php: This file will add the first admin to the database and allow you to log in to the system.
