<?php
include 'db.php';
include 'session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            background-color: white;
            /* background-image: url('bg.avif'); */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            height: 1300px;
        }

        #heading {
            font-size: 34px;
        }

        #signup {
            background-color:blue;
            color: white;
        }

        #signup:hover {
            cursor: pointer;
            background-color: green;
            color: white;
            height: 40px;
            width: 80px;
        }

        #login {
            background-color: #333;
            color: white;
        }

        #login:hover {
            cursor: pointer;
            background-color: green;
            color: white;
            height: 40px;
            width: 80px;
        }

        #footer {
            margin-top: 200px;
            position: relative;
        }

        /* Default content CSS********************************************************** */
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 36px;
        }

        header p {
            margin: 5px 0;
            font-size: 18px;
        }

        main {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            line-height: 1.6;
            color: #555;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .feature-box {
            flex: 1 1 calc(45% - 10px);
            background-color: #f1f1f1;
            margin: 10px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .feature-box h3 {
            color: #007bff;
            font-size: 20px;
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            font-size: 14px;
            color: #888;
        }
        /* Base Styling */
#heading {
    font-size: 24px;  
    color: white;
    text-decoration: none;  
    font-weight: bold;
    transition: font-size 0.3s ease;  
}

/* Hover Effect */
#heading:hover {
    color: #f0a500;  
}

/* Responsive Styling */
@media (max-width: 768px) {
    #heading {
        font-size: 19px;  
    }
}

@media (max-width: 480px) {
    #heading {
        font-size: 17px; 
    }
}
@media (max-width: 280px) {
    #heading {
        font-size: 12px;  
    }
}

    </style>

</head>

<body>
    <nav class="navbar bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" id="heading">PHP CRUD BASED AUTHENTICATION</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Navbar************************************************************************************* -->
    <header class="mt-5">
        <h1>Authentication System Overview</h1>
        <p>Secure and efficient modal-based login and signup</p>
    </header>

    <main>
        <h2>About the Authentication System</h2>
        <div class="info">
            <p>This authentication system is designed with a modern modal-based interface, ensuring seamless and secure access for users. With the CRUD operations, logged-in users can manage their posts efficiently, and only authorized actions are allowed for each user.</p>
            <p>The system is built with a focus on usability and security, allowing users to perform tasks like creating, viewing, updating, and deleting their posts while ensuring their sessions remain secure.</p>
        </div>

        <h2>Key Features</h2>
        <div class="features">
            <div class="feature-box">
                <h3>Secure Login</h3>
                <p>Users can log in securely using their credentials, with session management to ensure data safety.</p>
            </div>
            <div class="feature-box">
                <h3>Modal-Based Interface</h3>
                <p>A modern, user-friendly modal design for login and signup without page reloads.</p>
            </div>
            <div class="feature-box">
                <h3>Create Posts</h3>
                <p>Logged-in users can create posts and share their ideas with ease.</p>
            </div>
            <div class="feature-box">
                <h3>Manage Posts</h3>
                <p>Users can view, edit, and delete their posts, providing complete control over their content.</p>
            </div>
            <div class="feature-box">
                <h3>Logout</h3>
                <p>A single-click logout option to end the session securely and prevent unauthorized access.</p>
            </div>
        </div>
    </main>

    <!-- Default Content************************************************ -->
    <div class="container mt-5">
        <?php if (!isLoggedIn()): ?>
            <div class="text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal" id="signup">Signup</button>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal" id="login">Login</button>
            </div>
        <?php else: ?>
            <div class="text-center">
                <h1>Welcome..! <?php echo getUsername(); ?></h1>
                <button class="btn btn-danger" id="logoutBtn">Logout</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#postModal">Create Post</button>
            </div>

            <h2 class="mt-4">Your Posts</h2>
            <div id="postsContainer" class="mt-3"></div>
        <?php endif; ?>
    </div>

    <?php include 'modals.php'; ?>
    <!-- Footer************************************************************************ -->
    <footer class="bg-dark text-white pt-5 pb-4  " id="footer">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">

                <!-- About Section -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">About Us</h5>
                    <p>
                        We are dedicated to providing high-quality services. Follow us on our social channels for updates.
                    </p>
                </div>

                <!-- Links Section -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Links</h5>
                    <p>
                        <a href="#home" class="text-white" style="text-decoration: none;">Home</a>
                    </p>
                    <p>
                        <a href="#about" class="text-white" style="text-decoration: none;">About</a>
                    </p>
                    <p>
                        <a href="#services" class="text-white" style="text-decoration: none;">Services</a>
                    </p>
                    <p>
                        <a href="#contact" class="text-white" style="text-decoration: none;">Contact</a>
                    </p>
                </div>

                <!-- Contact Section -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
                    <p>
                        <i class="fas fa-home mr-3"></i> Sialkot, Pakistan
                    </p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> muhammadbilal036356@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> +92-307-9599169
                    </p>
                </div>

                <!-- Social Section -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Follow Us</h5>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-facebook fa-lg mr-4"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-twitter fa-lg mr-4"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-instagram fa-lg mr-4"></i>
                    </a>
                    <a href="#" class="text-white text-decoration-none">
                        <i class="fab fa-linkedin fa-lg mr-4"></i>
                    </a>
                </div>
            </div>

            <hr class="mb-4" />

            <!-- Copyright Section -->
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p class="text-white">
                        © 2024 PHP CRUD BASED AUTHENTICATION | All rights reserved
                    </p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <p class="text-white text-md-right">
                        Developed by <span class="text-warning">Muhammad Bilal</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="scripts.js"></script>
</body>

</html>