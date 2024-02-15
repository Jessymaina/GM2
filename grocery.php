
<?php
require_once('connection.php');
?>
<?php
if(isset($_POST['submit'])) {
    // Retrieve form data
    $NAME = $_POST['NAME'];
    $EMAIL = $_POST['EMAIL'];
    $MESSAGE = $_POST['MESSAGE'];
    if(empty($NAME) || empty($EMAIL) || empty($MESSAGE)) {
        // Display error message and prevent form submission
        echo "Please fill in all fields.";
    } else {
        // Get current date in YYYY-MM-DD format
        $TODAY = date('Y-m-d');
        // Assuming default status is 1
        $STATUS = 1;


        // Perform SQL query to insert form data into the database
        $sqlenquiry = "INSERT INTO enquiries (NAME, EMAIL, MESSAGE, STATUS, DATECREATED) VALUES ('$NAME', '$EMAIL', '$MESSAGE', '$STATUS', '$TODAY')";

        if (mysqli_query($con, $sqlenquiry)) {
            // If query is successful, display success message or perform any other actions
            echo "Record added successfully";
        } else {
            // If there is an error in the query, display error message
            echo "Error: " . $sqlenquiry . "<br>" . mysqli_error($con);
        }

        // Close database connection
        //mysqli_close($con);
    }
    

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tumaini Groceries</title>
    <style>
        /* Your CSS styles here */
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/grocery.css">
    <link rel="stylesheet" href="css/general.css">
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
            <div class="fas fa-shopping-cart" id="cart-btn"><span id="itemsincart">0</span></div>
            <div class="fas fa-user" id="login-btn"></div>
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
      <img src="assets/home5.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/home4.png" class="d-block w-100" alt="...">
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
                echo '  <div>';
                echo '      <button class="minus">-</button>';
                echo '      <label class="label">0</label>';
                echo '      <button class="plus">+</button>';
                echo '  </div>';
                echo '  <button class="add" data-product-code="' . $row["productcode"] . '" data-product-name="' . $row["productname"] . '" data-product-price="' . $row["productprice"] . '"><i class="fas fa-shopping-cart"></i> Add</button>';
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

<div id="cart-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Shopping Cart</h2>
        <div id="cart-items" style="margin:20px; ">
            <!-- Cart items will be displayed here -->
        </div>
        <button id="checkout-btn" style="border: 4px solid black; font-size: 16px;border-radius: 20px; margin:20px; padding: 10px 20px; background: orange; width: 150px; height: 50px; color: black;">Checkout</button>
    </div>
</div>

    </section>
<!--        
                <div class="card">
                    <img src="assets/tomato.png" class="myimage" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">tomato</h5>
                        <p class="card-text">Price: $19.99</p>
                        <a href="#" class="">more</a>
                    </div>
              <div class="cartcontrols">
                <div>
                    <button class="minus">-</button>
                    <label for="" class="label">0</label>
                    <button class="plus">+</button>

                </div>
                <button class="add">add to cart</button>
              </div>
                </div>
                
            </div>
        </div> -->

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
    <form id="myForm" action="respond.php" method="POST">  <!--removed respond.php in action -->
    <div class="mb-3">
        <label for="NAME" class="form-label">Your Name</label>
        <input type="text" class="form-control" id="name" name="NAME" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="EMAIL" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="MESSAGE" rows="3" required></textarea>
    </div>
    <button type="submit" name="submit" class="mybutton btnorange">Submit</button>
</form>
            <p>Contact Information:</p>
            <p>Email: <a href="mailto:codjecinta@gmail.com">codjecinta@gmail.com</a></p>
            <p>Phone: <a href="tel:+254759419486">+254-759-419-486</a></p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let TotalAmount = parseFloat(localStorage.getItem("totalamount")) || 0;
            let cartItemList = JSON.parse(localStorage.getItem("cartItems")) || [];

            const itemsInCart = document.getElementById('itemsincart');
            const cartModal = document.getElementById('cart-modal');
            const cartItems = document.getElementById('cart-items');
            const totalAmountDisplay = document.getElementById('total-amount');
            const checkoutBtn = document.getElementById('checkout-btn');

            const plusButtons = document.querySelectorAll('.plus');
            const itemsavailable=document.querySelectorAll('.itemsavailable');
            let newitemsavailable;
            const minusButtons = document.querySelectorAll('.minus');
            const labels = document.querySelectorAll('.label');
            const cartButtons = document.querySelectorAll('.add');

            // Calculate the total quantity of items in cartItemList
            let totalItemsInCart = cartItemList.reduce((total, item) => total + item.quantity, 0);
            itemsInCart.textContent = totalItemsInCart;

            plusButtons.forEach((button, index) => {
                button.addEventListener('click', function () {
                    let value = parseInt(labels[index].textContent);
                    newitemsavailable = parseInt(itemsavailable[index].textContent)
                   console.log(newitemsavailable);

                    if (newitemsavailable >0) {
                    labels[index].textContent = value + 1;
                    newitemsavailable = parseInt(itemsavailable[index].textContent)
                    itemsavailable[index].textContent =newitemsavailable - 1;
                    }
                    else{
                        console.log("operation not allowed");
                    }
                });
            });

            minusButtons.forEach((button, index) => {
                button.addEventListener('click', function () {
                    let value = parseInt(labels[index].textContent);
                 
                    if (value > 0) {
                        newitemsavailable = parseInt(itemsavailable[index].textContent)
                        itemsavailable[index].textContent =newitemsavailable + 1;
                        labels[index].textContent = value - 1;
                    }
                    else{
                        console.log("operation not allowed");
                    }
                });
            });

            cartButtons.forEach((button, index) => {
                button.addEventListener('click', function () {
                    const productName = this.dataset.productName;
                    let productPrice = parseFloat(this.dataset.productPrice);
                    const quantity = parseInt(labels[index].textContent);
                    const totalPrice = productPrice * quantity;

                    // Check if the product is already in cartItemList
                    const existingItemIndex = cartItemList.findIndex(item => item.productName === productName);

                    if (existingItemIndex !== -1) {
                        // Update existing item's quantity and total price
                        cartItemList[existingItemIndex].quantity += quantity;
                        cartItemList[existingItemIndex].totalPrice += totalPrice;
                    } else {
                        // Add new item to cartItemList
                        cartItemList.push({
                            productName: productName,
                            quantity: quantity,
                            totalPrice: totalPrice
                        });
                    }

                    // Update TotalAmount
                    TotalAmount += totalPrice;

                    // Update localStorage
                    localStorage.setItem("cartItems", JSON.stringify(cartItemList));
                    localStorage.setItem("totalamount", TotalAmount);

                    // Update total quantity of items in cart span
                    totalItemsInCart += quantity;
                    itemsInCart.textContent = totalItemsInCart;

                    // Update UI
                    labels[index].textContent = 0;
                    displayCartItems();
                });
            });

            document.getElementById('cart-btn').addEventListener('click', function () {
                cartModal.style.display = 'block';
            });

            document.querySelector('.close').addEventListener('click', function () {
                cartModal.style.display = 'none';
            });

            checkoutBtn.addEventListener('click', function () {
                // Implement checkout functionality here
            });

            function displayCartItems() {
                cartItems.innerHTML = '';
                cartItemList.forEach(item => {
                    const itemHTML = `
                        <div class="cart-item">
                            <p>${item.productName}</p>
                            <p>Quantity: ${item.quantity}</p>
                            <p>Total Price: ${item.totalPrice.toFixed(2)}</p>
                            <button class="minus">-</button>
                            <button class="plus">+</button>
                        
                        </div>
                    `;
                    cartItems.insertAdjacentHTML('beforeend', itemHTML);
                });
                totalAmountDisplay.textContent = TotalAmount.toFixed(2);
            }

            displayCartItems(); // Initial display
        });
    </script>
    
</body>

</html>