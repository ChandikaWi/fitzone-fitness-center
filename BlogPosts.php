<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fitzone_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore FitZone's blog for fitness tips, workout guides, and health advice.">
    <title>Blog - FitZone Fitness Center</title>
    <link rel="icon" type="image/jpeg" href="/Pictures/WebIcon1.jpeg">
    <link rel="stylesheet" href="Home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .blog-header, .blog-page-container, .blog-footer {
            --primary-color: #dc2626;
            --primary-dark: #b91c1c;
            --primary-light: #ef4444;
            --secondary-color: #1f2937;
            --accent-color: #f59e0b;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --bg-card: rgba(255, 255, 255, 0.9);
            --bg-glass: rgba(255, 255, 255, 0.1);
            --bg-dark-accent: #111827;
            --text-primary: #111827;
            --text-secondary: #374151;
            --text-muted: #6b7280;
            --text-inverse: #ffffff;
            --border-color: #e5e7eb;
            --border-hover: #d1d5db;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-glow: 0 0 20px rgba(220, 38, 38, 0.3);
            --shadow-red: 0 10px 25px rgba(220, 38, 38, 0.15);
            --gradient-primary: linear-gradient(135deg, #dc2626, #b91c1c);
            --gradient-text: linear-gradient(135deg, #dc2626, #b91c1c);
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;
            --transition-fast: 150ms ease;
            --transition-base: 250ms ease;
            --transition-slow: 350ms ease;
        }

        .dark-theme .blog-header,
        .dark-theme .blog-page-container,
        .dark-theme .blog-footer {
            --bg-primary: #000000;
            --bg-secondary: #111827;
            --bg-tertiary: #1f2937;
            --bg-card: rgba(31, 41, 55, 0.9);
            --bg-glass: rgba(0, 0, 0, 0.2);
            --bg-dark-accent: #374151;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-muted: #9ca3af;
            --border-color: #374151;
            --border-hover: #4b5563;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
            --shadow-red: 0 10px 25px rgba(220, 38, 38, 0.25);
        }

        /* Base Styles */
        .blog-page-container * {
            box-sizing: border-box;
            font-family: var(--font-family);
        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: var(--space-4);
            right: var(--space-4);
            z-index: 1001;
            width: 50px;
            height: 50px;
            border-radius: var(--radius-full);
            border: none;
            background: var(--gradient-primary);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-lg);
            box-shadow: var(--shadow-lg);
            transition: all var(--transition-base);
        }

        .theme-toggle:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-glow);
        }

        .light-theme .theme-toggle .fa-sun {
            display: none;
        }

        .dark-theme .theme-toggle .fa-moon {
            display: none;
        }

        /* Header */
        .blog-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            transition: all var(--transition-base);
        }

        .blog-header.scrolled {
            background: var(--bg-primary);
            box-shadow: var(--shadow-md);
        }

        .blog-header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4);
        }

        .blog-header .logo h1 {
            font-size: var(--font-size-2xl);
            font-weight: 800;
            background: var(--gradient-text);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0;
        }

        .blog-header .logo .accent {
            color: var(--secondary-color);
        }

        .blog-header .tagline {
            font-size: var(--font-size-xs);
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .blog-header .nav {
            display: flex;
            align-items: center;
        }

        .blog-header .nav-list {
            display: flex;
            list-style: none;
            align-items: center;
            gap: var(--space-6);
        }

        .blog-header .nav-close {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            border: none;
            background: var(--gradient-primary);
            color: white;
            cursor: pointer;
            font-size: var(--font-size-lg);
            transition: all var(--transition-base);
        }

        .blog-header .nav-close:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-glow);
        }

        .blog-header .header-actions {
            display: flex;
            gap: var(--space-4);
        }

        .blog-header .search-toggle {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            border: none;
            background: var(--gradient-primary);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--font-size-base);
            transition: all var(--transition-base);
        }

        .blog-header .search-toggle:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-glow);
        }

        .blog-header .mobile-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: var(--space-2);
        }

        .blog-header .mobile-toggle span {
            width: 25px;
            height: 3px;
            background: var(--text-primary);
            transition: all var(--transition-base);
        }

        .blog-header .mobile-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .blog-header .mobile-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .blog-header .mobile-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Search Container */
        .blog-header .search-container {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            z-index: 999;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            padding: var(--space-4);
            border-bottom: 1px solid var(--border-color);
            transform: translateY(-100%);
            transition: transform var(--transition-base);
        }

        .blog-header .search-container.active {
            transform: translateY(0);
        }

        .blog-header .search-wrapper {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .blog-header .search-wrapper input {
            width: 100%;
            padding: var(--space-4) var(--space-16) var(--space-4) var(--space-6);
            border: 2px solid var(--border-color);
            border-radius: var(--radius-full);
            background: var(--bg-primary);
            color: var(--text-primary);
            font-size: var(--font-size-base);
            transition: all var(--transition-base);
        }

        .blog-header .search-wrapper input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-glow);
        }

        .blog-header .search-btn {
            position: absolute;
            right: var(--space-2);
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border: none;
            border-radius: var(--radius-full);
            background: var(--gradient-primary);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-base);
        }

        .blog-header .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
        }

        /* Blog Page Content */
        .blog-page-container {
            padding: var(--space-24) 0;
        }

        .blog-page-container h1 {
            max-width: 1200px;
            margin: 40px auto 20px;
            font-size: var(--font-size-4xl);
            font-weight: 800;
            color: var(--text-primary);
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .blog-page-container .image-gallery {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-4);
            padding: var(--space-4);
        }

        .blog-page-container .image-item {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: transform var(--transition-base), box-shadow var(--transition-base);
        }

        .blog-page-container .image-item:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-color);
        }

        .blog-page-container .image-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .blog-page-container .image-item h3 {
            padding: var(--space-4);
            font-size: var(--font-size-xl);
            font-weight: 500;
            color: var(--text-primary);
            text-align: center;
            margin: 0;
        }

        .blog-page-container p {
            max-width: 1200px;
            margin: var(--space-4) auto;
            padding: var(--space-4);
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            text-align: center;
            font-size: var(--font-size-lg);
            color: var(--accent-color);
            box-shadow: var(--shadow-md);
        }

        .dark-theme .blog-page-container p {
            color: var(--text-primary);
        }

        /* Footer */
        .blog-footer {
            background: var(--bg-tertiary);
            padding: var(--space-16) 0 var(--space-8);
        }

        .blog-footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-4);
        }

        .blog-footer .footer-main {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-12);
            margin-bottom: var(--space-8);
        }

        .blog-footer .footer-section {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .blog-footer .footer-brand h3 {
            font-size: var(--font-size-2xl);
            font-weight: 800;
            margin-bottom: var(--space-2);
        }

        .blog-footer .footer-brand p {
            color: var(--text-muted);
            margin-bottom: var(--space-6);
        }

        .blog-footer .contact-info {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .blog-footer .contact-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: var(--text-secondary);
        }

        .blog-footer .contact-item i {
            color: var(--primary-color);
            font-size: var(--font-size-base);
        }

        .blog-footer .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .blog-footer .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: var(--font-size-sm);
            transition: all var(--transition-base);
        }

        .blog-footer .footer-links a:hover {
            color: var(--primary-color);
        }

        .blog-footer .opening-hours {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .blog-footer .hours-item {
            display: flex;
            justify-content: space-between;
            color: var(--text-secondary);
            font-size: var(--font-size-sm);
        }

        .blog-footer .social-links {
            display: flex;
            gap: var(--space-4);
        }

        .blog-footer .social-links a {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all var(--transition-base);
        }

        .blog-footer .social-links a:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-glow);
        }

        .blog-footer .footer-features {
            display: flex;
            justify-content: space-around;
            gap: var(--space-4);
        }

        .blog-footer .feature-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: var(--text-secondary);
            font-size: var(--font-size-sm);
        }

        .blog-footer .feature-icon {
            color: var(--primary-color);
            font-size: var(--font-size-base);
        }

        .blog-footer .feature-text h5 {
            font-size: var(--font-size-base);
            font-weight: 600;
            margin-bottom: var(--space-1);
        }

        .blog-footer .feature-text p {
            color: var(--text-muted);
            font-size: var(--font-size-xs);
        }

        .blog-footer .footer-bottom {
            text-align: center;
            padding-top: var(--space-8);
            border-top: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: var(--font-size-sm);
        }

        .blog-footer .footer-legal {
            display: flex;
            justify-content: center;
            gap: var(--space-4);
            margin-top: var(--space-2);
        }

        .blog-footer .footer-legal a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: all var(--transition-base);
        }

        .blog-footer .footer-legal a:hover {
            color: var(--primary-color);
        }

        .blog-footer .separator {
            color: var(--text-muted);
        }

        /* Buttons */
        .blog-header .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-4) var(--space-8);
            border: none;
            border-radius: var(--radius-full);
            font-size: var(--font-size-base);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all var(--transition-base);
            text-align: center;
            white-space: nowrap;
        }

        .blog-header .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .blog-header .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-header .nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: var(--bg-card);
                backdrop-filter: blur(20px);
                transition: left var(--transition-base);
                padding: var(--space-8);
            }

            .blog-header .nav.active {
                left: 0;
            }

            .blog-header .nav-list {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-4);
            }

            .blog-header .nav-close,
            .blog-header .mobile-toggle,
            .blog-header .search-toggle {
                display: flex;
            }

            .blog-page-container h1 {
                font-size: var(--font-size-3xl);
                margin: var(--space-8) auto var(--space-4);
            }

            .blog-page-container .image-gallery {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: var(--space-3);
                padding: var(--space-3);
            }

            .blog-page-container .image-item img {
                height: 180px;
            }

            .blog-page-container .image-item h3 {
                font-size: var(--font-size-lg);
                padding: var(--space-3);
            }

            .blog-page-container p {
                font-size: var(--font-size-base);
                padding: var(--space-3);
            }

            .blog-footer .footer-main {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .blog-footer .footer-features {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .blog-header .container {
                padding: var(--space-2);
            }

            .blog-header .logo h1 {
                font-size: var(--font-size-xl);
            }

            .blog-header .tagline {
                font-size: var(--font-size-xs);
            }

            .blog-page-container h1 {
                font-size: var(--font-size-2xl);
            }

            .blog-page-container .image-gallery {
                grid-template-columns: 1fr;
                gap: var(--space-2);
                padding: var(--space-2);
            }

            .blog-page-container .image-item img {
                height: 160px;
            }

            .blog-page-container .image-item h3 {
                font-size: var(--font-size-base);
            }

            .blog-page-container p {
                font-size: var(--font-size-sm);
            }

            .blog-footer .footer-brand h3 {
                font-size: var(--font-size-xl);
            }

            .blog-footer .footer-links a,
            .blog-footer .hours-item,
            .blog-footer .footer-bottom,
            .blog-footer .footer-legal a {
                font-size: var(--font-size-xs);
            }
        }
    </style>
</head>
<body class="light-theme">
    <!-- Theme Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle between light and dark theme">
        <i class="fas fa-moon"></i>
        <i class="fas fa-sun"></i>
    </button>

    <!-- Header -->
    <header class="blog-header" role="banner">
        <div class="container">
            <div class="logo">
                <h1>Fit<span class="accent">Zone</span></h1>
                <p class="tagline">Transform Your Life</p>
            </div>
            <nav class="nav" id="nav" role="navigation" aria-label="Main navigation">
                <button class="nav-close" id="navClose" aria-label="Close navigation">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="nav-list">
                </ul>
            </nav>
            <div class="header-actions">
                <button class="search-toggle" id="searchToggle" aria-label="Toggle search bar" aria-expanded="false">
                    <i class="fas fa-search"></i>
                </button>
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle mobile navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="search-container" id="searchContainer" role="search">
        <div class="search-wrapper">
            <input type="text" id="searchInput" placeholder="Search for blog posts, programs, services...">
            <button class="search-btn" onclick="searchWebsite()" aria-label="Search">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Blog Content -->
    <main class="blog-page-container" role="main">
        <h1>OUR BLOG</h1>
        <div class="image-gallery">
        <?php
        $conn = new mysqli("localhost", "root", "", "fitzone_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='image-item'>";
                echo "<img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["title"]) . "'>";
                echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                echo "</div>";
            }
        } else {
            echo "<p>No blog posts yet.</p>";
        }
        $conn->close();
        ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="blog-footer" role="contentinfo">
        <div class="container">
            <div class="footer-main">
                <div class="footer-section">
                    <div class="footer-brand">
                        <h3>Fit<span class="accent">Zone</span></h3>
                        <p class="brand-tagline">Where Champions Are Made</p>
                        <p class="brand-description">Transform your body, elevate your mind, and unleash your potential at FitZone - the ultimate destination for serious fitness enthusiasts.</p>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+94 77 123 4567</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>info@fitzone.lk</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Kurunegala, Sri Lanka</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="./Home.html">Home</a></li>
                        <li><a href="./Program.html">Programs</a></li>
                        <li><a href="./Membership.html">Membership</a></li>
                        <li><a href="./Timetable.html">Timetable</a></li>
                        <li><a href="./Trainers.html">Trainers</a></li>
                        <li><a href="./Aboutus.html">About Us</a></li>
                        <li><a href="http://localhost/MyProject/Contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Programs</h4>
                    <ul class="footer-links">
                        <li><a href="./Program.html#fitness-program">Fitness Program</a></li>
                        <li><a href="./Program.html#personalized-training">Personalized Training</a></li>
                        <li><a href="./Program.html#group-classes">Group Classes</a></li>
                        <li><a href="./Program.html#nutrition-counseling">Nutrition Counseling</a></li>
                        <li><a href="./Program.html#cardio-yoga">Cardio & Yoga</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Opening Hours</h4>
                    <div class="opening-hours">
                        <div class="hours-item">
                            <span class="day">Monday - Friday</span>
                            <span class="time">5:00 AM - 11:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Saturday</span>
                            <span class="time">6:00 AM - 10:00 PM</span>
                        </div>
                        <div class="hours-item">
                            <span class="day">Sunday</span>
                            <span class="time">7:00 AM - 9:00 PM</span>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com" target="_blank" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.youtube.com" target="_blank" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-virus"></i>
                    </div>
                    <div class="feature-text">
                        <h5>Sanitized & Safe</h5>
                        <p>Health protocols maintained</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="feature-text">
                        <h5>Certified Trainers</h5>
                        <p>Expert fitness professionals</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <div class="feature-text">
                        <h5>Premium Equipment</h5>
                        <p>State-of-the-art machines</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-text">
                        <h5>Flexible Hours</h5>
                        <p>Extended daily access</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date("Y"); ?> FitZone Fitness Center. All Rights Reserved.</p>
                    <div class="footer-legal">
                        <a href="./PrivacyPolicy.html">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="./TermsOfService.html">Terms of Service</a>
                        <span class="separator">|</span>
                        <a href="./CookiePolicy.html">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-theme');
            body.classList.toggle('light-theme');
            localStorage.setItem('theme', body.classList.contains('dark-theme') ? 'dark' : 'light');
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            body.classList.remove('light-theme');
            body.classList.add('dark-theme');
        }

        // Mobile Navigation
        const mobileToggle = document.getElementById('mobileToggle');
        const navClose = document.getElementById('navClose');
        const nav = document.getElementById('nav');

        mobileToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
            mobileToggle.classList.toggle('active');
            mobileToggle.setAttribute('aria-expanded', nav.classList.contains('active'));
        });

        navClose.addEventListener('click', () => {
            nav.classList.remove('active');
            mobileToggle.classList.remove('active');
            mobileToggle.setAttribute('aria-expanded', 'false');
        });

        // Search Toggle
        const searchToggle = document.getElementById('searchToggle');
        const searchContainer = document.getElementById('searchContainer');

        searchToggle.addEventListener('click', () => {
            searchContainer.classList.toggle('active');
            searchToggle.setAttribute('aria-expanded', searchContainer.classList.contains('active'));
        });

        // Search Function
        function searchWebsite() {
            let query = document.getElementById("searchInput").value.toLowerCase().trim();
            let pages = {
                "home": "./Home.html",
                "programs": "./Program.html#programs",
                "fitness": "./Program.html#fitness-program",
                "personalized": "./Program.html#personalized-training",
                "group": "./Program.html#group-classes",
                "nutrition": "./Program.html#nutrition-counseling",
                "cardio": "./Program.html#cardio-yoga",
                "yoga": "./Program.html#cardio-yoga",
                "membership": "./Membership.html",
                "timetable": "./Timetable.html",
                "trainers": "./Trainers.html",
                "about": "./Aboutus.html",
                "contact": "http://localhost/MyProject/Contact.html",
                "blog": "./BlogPage.php"
            };

            for (let key in pages) {
                if (query.includes(key)) {
                    window.location.href = pages[key];
                    return;
                }
            }
            alert("No results found. Try searching for: blog, fitness, personalized, group, nutrition, cardio, yoga, or membership.");
        }

        // Enter key search
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchWebsite();
            }
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.blog-header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>