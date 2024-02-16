<?php
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tumaini Groceries</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/grocery.css">
    <link rel="stylesheet" href="css/general.css">
    <style>
            .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
        }

        .product img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product button {
            background-color: #4CAF50;
            border: none;
            color: yellow;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        .product button:hover {
            background-color: #45a049;
        }
    </style>
    </style>
</head>

<body>
    <header class="header">
        <a href="#" class="logo"><i class="fas fa-shopping-basket"></i> Tumaini</a>
        <nav class="navbar">
            <a href="#Home">Home</a>
            <a href="#About">About</a>
            <a href="#Products">Products</a>
            <a href="#Reviews">Reviews</a>
            <a href="#Contact">Contact</a>
        </nav>
        
        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-search" id="search-btn"></div>
            <div  id="login-btn"> <a href="index.php" class="fas fa-user"></a></div>
        </div>
        <form action="" class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>

    <!-- Home Section - Carousel -->
    <section id="Home">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active ">
      <img src="assets/test1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/test1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/test1.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    </section>

    <!-- About Section -->
    <section id="About">
        <div class="container">
            <h2>About Tumaini Groceries</h2>
            <p> Welcome to Tumaini Groceries, your premier destination for all your grocery needs! 
                Step into a world of convenience and quality as we bring the supermarket experience directly to your fingertips. 
                From fresh produce to pantry essentials, we offer a wide selection of high-quality products curated to meet your every culinary requirement. 
                With our user-friendly online platform, shopping for groceries has never been easier.
                Say goodbye to long queues and crowded aisles – simply browse, click, and have your items delivered straight to your doorstep.
                Experience the joy of hassle-free shopping with Tumaini Groceries today!</p>
        </div>
    </section>

    <!-- Products Section -->
    <section id="Products" style="padding-left:100px;">
    <h2>Featured Products</h2>
    <div class="product-container">
        <?php
        require_once('connection.php');

        $sql = "SELECT * FROM product";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<h3>" . $row["productname"] . "</h3>";
                echo "<p>Price: $" . $row["productprice"] . "</p>";
                echo "<p>Quantity: <span id='quantity-" . $row["productcode"] . "' class='itemsavailable'>" . $row["productquantity"] . "</span></p>";
                echo "<p>Description: " . $row["productdescription"] . "</p>";
                echo "<img src='" . $row["file"] . "' alt='" . $row["productname"] . "'>";
                echo '<div class="cartcontrols">';
                            echo '</div>';
                echo "</div>"; // Close product container
            }
        } else {
            echo "No products available";
        }

        mysqli_close($con);
        ?>
    </div>
</section>


    <!-- Reviews Section -->
    <section id="Reviews">
    <br>
    <br>
    <br>
    <br>
    <br>
    <h2 style="margin-left:100px;">Customer Reviews</h2>
    <div id="customerReviewsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer 1</h5>
                        <p class="card-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                        <div class="rating">
                            &#9733;&#9733;&#9733;&#9733;&#9733; <!-- Five filled stars -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer 2</h5>
                        <p class="card-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                        <div class="rating">
                            &#9733;&#9733;&#9733;&#9733;&#9733; <!-- Five filled stars -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer 3</h5>
                        <p class="card-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
                        <div class="rating">
                            &#9733;&#9733;&#9733;&#9733;&#9733; <!-- Five filled stars -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#customerReviewsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#customerReviewsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    </section>

    <!-- Contact Section -->
    <section id="Contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>For any inquiries or assistance, please feel free to contact us.</p>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="mybutton btnorange" >Submit</button>
            </form>
            <p>Contact Information:</p>
            <p>Email: info@tumainigroceries.com</p>
            <p>Phone: +1 (123) 456-7890</p>
        </div>
    </section>
     <!-- Footer section -->
     <footer>
        <div class="social-icons">
            <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
            <!-- Add more social media icons as needed -->
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="js/grocery.js"></script>
</body>

</html>
