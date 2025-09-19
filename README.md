# FitZone Fitness Center Website

Welcome to the FitZone Fitness Center website! This project is a responsive web application designed to provide information about fitness programs, membership details, trainer profiles, and contact options for the FitZone Fitness Center located in Kurunegala, Sri Lanka. Users can register, log in, explore blog posts, and get in touch with the center through various channels. The application includes an admin and staff interface for managing data.

## Overview

The FitZone Fitness Center website offers:
- A user-friendly interface with light/dark theme toggle.
- Registration and login functionality for customers, admins, and staff.
- A blog section to share fitness tips and updates.
- Contact forms with messages saved to a database.
- Membership and appointment management.
- Interactive features like search, back-to-top button, and animations.

## Features
- **Responsive Design**: Optimized for desktop, tablet, and mobile devices.
- **Theme Toggle**: Switch between light and dark themes with persistence via localStorage.
- **User Management**: Register as a customer, admin, or staff with secure password hashing.
- **Contact Management**: Submit inquiries via a form, stored with timestamps.
- **Blog Section**: Display blog posts with titles and images, retrieved from a database.
- **Membership Tracking**: Record customer memberships with types and prices.
- **Appointment Scheduling**: Book gym appointments with trainers and services.
- **Search Functionality**: Search across pages and sections with smooth scrolling or redirection.
- **Animations**: Smooth fade-in effects using Intersection Observer.
- **Accessibility**: ARIA labels and roles for better screen reader support.

## Technologies Used
- **HTML5**: Structure of the web pages.
- **CSS3**: Styling with custom variables, Tailwind-inspired design, and media queries.
- **JavaScript**: Client-side interactivity (theme toggle, search, form validation, AJAX).
- **PHP**: Server-side logic for form submissions and database interactions.
- **MySQL**: Database management (MariaDB 10.4.32) for user data, messages, and blog posts.
- **Font Awesome**: Icons for enhanced UI.
- **Google Maps API**: Embedded map for location visualization.

## Prerequisites
- A web server with PHP support (XAMPP).
- MySQL or MariaDB database server (version 10.4.32 or higher recommended).
- PHP version 8.0.30 or compatible.
- Web browser (Chrome, Firefox, Edge, etc.).

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/ChandikaWi/fitzone-fitness-center.git
cd fitzone-fitness-center
```

### 2. Set Up the Database
1. Install a local server environment (XAMPP).
2. Start the Apache and MySQL services.
3. Create a database named `fitzone_db` in phpMyAdmin or via MySQL command line:
   ```sql
   CREATE DATABASE fitzone_db;
   ```
4. Import the database schema and sample data using the provided SQL dump:
   - Open phpMyAdmin, select the `fitzone_db` database, and import the `fitzone_db.sql` file (or execute the SQL commands below).
   - Alternatively, run the following SQL commands manually:
     ```sql
     -- Table: admins
     CREATE TABLE `admins` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `username` varchar(50) NOT NULL,
       `password` varchar(255) NOT NULL,
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `admins` (`id`, `username`, `password`) VALUES
     (1, 'Admin1', '$2y$10$vlszRJC9beMCsMTLxvmYBeuk.oUbN2qfduGl1VzlBKkIs.DN8YUD6');

     -- Table: blog_posts
     CREATE TABLE `blog_posts` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `title` varchar(255) NOT NULL,
       `image` varchar(255) NOT NULL,
       `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `blog_posts` (`id`, `title`, `image`, `created_at`) VALUES
     (3, 'Meal Plans', 'uploads/Meal Plans.jpeg', '2025-03-26 12:21:39'),
     (4, 'Workout Routines', 'uploads/Workout Routines.jpeg', '2025-03-28 13:29:21'),
     (5, 'Healthy Recipes', 'uploads/Healthy Recipes.jpeg', '2025-04-09 01:06:17'),
     (6, 'Success Stories', 'uploads/Success Stories.jpg', '2025-04-09 01:06:50');

     -- Table: contact_messages
     CREATE TABLE `contact_messages` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `name` varchar(100) NOT NULL,
       `email` varchar(100) NOT NULL,
       `message` text NOT NULL,
       `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `submitted_at`) VALUES
     (1, 'Chandika', 'Chandika@gmail.com', 'Can I know about what are the limitations of you fitness center?', '2025-03-23 06:07:59'),
     (2, 'Nisal', 'Nisal@gmail.com', 'I want to know when you started this gym?', '2025-04-29 12:47:16'),
     (3, 'Dinuka', 'Dinuka@gmail.com', 'This is a message', '2025-04-30 06:14:39'),
     (4, 'Kavindu', 'Kavindu@gmail.com', 'Do you have a kids area?', '2025-09-19 04:07:25');

     -- Table: customers
     CREATE TABLE `customers` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `username` varchar(50) NOT NULL,
       `password` varchar(255) NOT NULL,
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `customers` (`id`, `username`, `password`) VALUES
     (1, 'Customer1', '$2y$10$tIOuOsGW4ccNrYFy5FZoz.1p3b5ZgA4GpPzu7NyC0eGJSn0OY0TuS'),
     (2, 'Customer2', '$2y$10$va8gZ37AXV6hKXbfT/60X.yBisFQ5difXR2gNKrM3QbQR.ALMuty6'),
     (3, 'Customer3', '$2y$10$ovH0CsJCFm/NG.vzIVKdE.IPOrS9fvaFhqYKG4hCiW1PbcbsMI5GO'),
     (4, 'Customer4', '$2y$10$86TuKGZX.5XZQUZcT.9QfurgR0YwnnI9.Jymgxb1gmdr872doxf4W'),
     (8, 'Customer5', '$2y$10$NoL.lIaNpiIyHoR8a55Xveilmbd02hVrqNeYzPmHCIWusT80zR1B2');

     -- Table: customer_memberships
     CREATE TABLE `customer_memberships` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `username` varchar(255) NOT NULL,
       `membership_type` varchar(50) NOT NULL,
       `price` decimal(10,2) NOT NULL,
       `purchased_at` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `customer_memberships` (`id`, `username`, `membership_type`, `price`, `purchased_at`) VALUES
     (1, 'Customer1', 'Silver - 1 Month', 10000.00, '2025-03-23 13:05:19'),
     (2, 'Customer2', 'Gold - Annual', 48000.00, '2025-04-29 13:17:10'),
     (3, 'Customer1', 'Platinum - Gents', 65000.00, '2025-04-30 06:19:59'),
     (4, 'Customer5', 'Platinum - Gents', 65000.00, '2025-09-19 04:22:31');

     -- Table: gym_appointments
     CREATE TABLE `gym_appointments` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `username` varchar(255) NOT NULL,
       `service` varchar(255) NOT NULL,
       `trainer` varchar(255) NOT NULL,
       `date` date NOT NULL,
       `time` time NOT NULL,
       `booked_at` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `gym_appointments` (`id`, `username`, `service`, `trainer`, `date`, `time`, `booked_at`) VALUES
     (1, 'Customer1', 'Personalized Training', 'Mr. Thilina Fernando', '2025-05-05', '04:30:00', '2025-03-24 12:29:40'),
     (2, 'Customer2', 'Nutrition Counseling', 'Mr. Akila Wijesinghe', '2025-05-16', '05:30:00', '2025-04-29 13:19:24'),
     (3, 'Customer1', 'Strength Training', 'Mr. Ravindra Perera', '2025-05-09', '03:55:00', '2025-04-30 06:21:00'),
     (4, 'Customer5', 'Strength Training', 'Mr. Ravindra Perera', '2025-09-30', '10:00:00', '2025-09-19 04:24:44');

     -- Table: staff
     CREATE TABLE `staff` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `username` varchar(50) NOT NULL,
       `password` varchar(255) NOT NULL,
       PRIMARY KEY (`id`),
       UNIQUE KEY `username` (`username`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
     INSERT INTO `staff` (`id`, `username`, `password`) VALUES
     (1, 'Staffmember1', '$2y$10$31nIZzZb.dM5ry3GKl4/ce7YHFLZz9EgXFMYRVG5kazPKGm0YXZLm'),
     (2, 'Staffmember2', '$2y$10$vMo4I/Yh/nPmOk5zqZLp5Owy7vTjK5h.M3NFJVIL.6v4GZCNM5hay');
     ```
5. Note: The `password` fields in `admins`, `customers`, and `staff` tables are hashed using PHP's `password_hash()` with `PASSWORD_DEFAULT` (bcrypt). Do not attempt to use the raw values directly.

### 3. Configure the Project
- Place all HTML, PHP, CSS, and image files in your web server's root directory (e.g., `htdocs` for XAMPP).
- Ensure the `Pictures` folder with `WebIcon1.jpeg` is accessible.
- Update file paths in the HTML files (e.g., `http://localhost/MyProject/`) to match your server setup.
- Verify the `uploads` directory exists and is writable for blog post images (adjust `image` paths in `post_blog.php` if needed).

### 4. Run the Project
- Start your local server.
- Open a browser and navigate to `http://localhost/MyProject/` (adjust the path based on your setup).
- Explore the website by visiting `Home.html`, `Contact.html`, `CustomerReg.html`, `LoginForm.html`, or `BlogPost.php`.

## Usage
- **Home**: Navigate to `./Home.html` for an overview.
- **Register**: Visit `./CustomerReg.html` to create a customer account.
- **Login**: Access `./LoginForm.html` for customers, admins, or staff (implement authentication logic).
- **Contact**: Use `./Contact.html` to send messages or find contact details.
- **Blog**: Check `./BlogPosts.php` for fitness articles.
- Toggle themes using the moon/sun icon in the top-right corner.
- Use the search bar to find pages or sections.
- Scroll to activate animations and use the back-to-top button for navigation.

## Database Schema
- **admins**: Stores admin users with `id`, `username`, and `password` (1 record: `Admin1`).
- **blog_posts**: Contains blog entries with `id`, `title`, `image`, and `created_at` (4 records: "Meal Plans", "Workout Routines", etc.).
- **contact_messages**: Holds contact form submissions with `id`, `name`, `email`, `message`, and `submitted_at` (4 records from "Chandika" to "Kavindu").
- **customers**: Manages customer accounts with `id`, `username`, and `password` (5 records: `Customer1` to `Customer5`).
- **customer_memberships**: Tracks memberships with `id`, `username`, `membership_type`, `price`, and `purchased_at` (4 records, e.g., "Silver - 1 Month" at 10,000.00).
- **gym_appointments**: Records appointments with `id`, `username`, `service`, `trainer`, `date`, `time`, and `booked_at` (4 records, e.g., "Personalized Training" with Mr. Thilina Fernando).
- **staff**: Stores staff users with `id`, `username`, and `password` (2 records: `Staffmember1`, `Staffmember2`) with a unique `username` constraint.

## Contributing
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes and commit them (`git commit -m "Add new feature"`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a pull request with a description of your changes.

## Issues
If you encounter bugs or have suggestions, please open an issue on the GitHub repository with details about the problem or feature request.

## License
This project is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute it, but please include the original license.

## Acknowledgments
- Font Awesome for icons.
- Google Maps for location embedding.

---

*Last updated: September 19, 2025, 05:37 PM +0530*
