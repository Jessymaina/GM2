<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .nav-links {
            margin-top: 10px;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }
        .card {
            width: 300px;
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .chart-container {
            width: 600px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Admin Dashboard</h1>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="admin.php">Add Products</a>
            <a href="products.php">View Products</a>
            <a href="user.php">System Users</a>
            <a href="customer.php">Customer Feedback</a>
        </div>
    </div>

    <div class="container">
        <!-- Sales Card -->
        <div class="card" onclick="window.location.href='salesreport.php';">
            <h2>Sales Report</h2>
            <p>Total sales: $5000</p>
            <canvas id="salesChart"></canvas>
        </div>

        <!-- Product Sales Card -->
        <div class="card" onclick="window.location.href='productsalesreport.php';">
            <h2>Product Sales Report</h2>
            <p>Total products sold: 200</p>
            <canvas id="productSalesChart"></canvas>
        </div>

        <!-- Users Card -->
        <div class="card" onclick="window.location.href='usersreport.php';">
            <h2>Users Report</h2>
            <p>Total users: 100</p>
            <canvas id="usersChart"></canvas>
        </div>

        <!-- Orders Card -->
        <div class="card" onclick="window.location.href='ordersreport.php';">
            <h2>Orders Report</h2>
            <p>Total orders: 50</p>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <script>
        // Sample sales data
        const salesData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Sales',
                data: [65, 59, 80, 81, 56, 55],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Sample product sales data
        const productSalesData = {
            labels: ['Product A', 'Product B', 'Product C', 'Product D', 'Product E'],
            datasets: [{
                label: 'Product Sales',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Sample users data
        const usersData = {
            labels: ['Admin', 'Customer', 'Guest'],
            datasets: [{
                label: 'Users',
                data: [20, 50, 30],
                backgroundColor: ['rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(255, 206, 86, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        };

        // Sample orders data
        const ordersData = {
            labels: ['Pending', 'Processing', 'Delivered'],
            datasets: [{
                label: 'Orders',
                data: [10, 20, 20],
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        };

        // Render sales chart
        const salesChartCanvas = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesChartCanvas, {
            type: 'bar',
            data: salesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render product sales chart
        const productSalesChartCanvas = document.getElementById('productSalesChart').getContext('2d');
        const productSalesChart = new Chart(productSalesChartCanvas, {
            type: 'bar',
            data: productSalesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render users chart
        const usersChartCanvas = document.getElementById('usersChart').getContext('2d');
        const usersChart = new Chart(usersChartCanvas, {
            type: 'doughnut',
            data: usersData,
            options: {}
        });

        // Render orders chart
        const ordersChartCanvas = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersChartCanvas, {
            type: 'pie',
            data: ordersData,
            options: {}
        });
    </script>
</body>
</html>
