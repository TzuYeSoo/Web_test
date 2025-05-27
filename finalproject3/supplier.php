<?php 
    require_once "connection.php";

    $sql = "SELECT firt_name, last_name, comapany_name, contact, user_status FROM supplier";

    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="uniform.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
            <div class="nav-items">
                <a href="dashboard.html" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <div class="nav-item dropdown active">
                    <i class="far fa-folder-open"></i>
                    <span>Inventory</span>
                    <i class="fas fa-chevron-down arrow"></i>
                    <div class="dropdown-content">
                        <a href="uniform.php" class="dropdown-item">
                            <i class="fas fa-shirt"></i>
                            <span>Uniform</span>
                        </a>
                        <a href="machine.php" class="dropdown-item">
                            <i class="fas fa-industry"></i>
                            <span>Machine</span>
                        </a>
                        <a href="equipment.php" class="dropdown-item active">
                            <i class="fas fa-cog"></i>
                            <span>Equipment</span>
                        </a>
                        <a href="consumable.php" class="dropdown-item">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Consumable</span>
                        </a>
                    </div>
                </div>
                <a href="reservation.php" class="nav-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Reservation</span>
                </a>
                <a href="supplier.php" class="nav-item active">
                    <i class="fas fa-truck-fast"></i>
                    <span>Supplier</span>
                </a>
                <a href="#" class="nav-item logout">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>

        <main class="main-content">
            
             <header>
                <div class="logo-section">
                    <img src="stilogo.png" alt="STI Logo" class="logo">
                    <h1>Supplier</h1>
                </div>
                <div class="user-account">
                    <img src="alden.png" alt="User" class="avatar">
                    <span>user account</span>
                </div>
            </header>

            <div class="filter-dropdowns">
                <select>
                    <option value="">Program</option>
                    <!-- Add program options here -->
                </select>
                <select>
                    <option value="">Size</option>
                    <!-- Add size options here -->
                </select>
                <select>
                    <option value="">Clothes part</option>
                    <!-- Add clothes part options here -->
                </select>
            </div>

            <div class="inventory-table">
                <table>
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Company Name</th>
                            <th>contact number</th>
                            <th>status</th>
                            <th>
                        
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            while($row=mysqli_fetch_assoc($result)){

                                ?> 
                                    <tr>
                                        <td><?php echo $row['firt_name']?></td>
                                        <td><?php echo $row['last_name']?></td>
                                        <td><?php echo $row['comapany_name']?></td>
                                        <td><?php echo $row['contact']?></td>
                                        <td><?php echo $row['user_status']?></td>
                                        <td>
                                            <i class="fas fa-pencil-alt"></i>
                                            <i class="fas fa-plus-circle"></i>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                        <!-- Add more rows here -->
                    </tbody>
                </table>
            </div>

            <button class="add-item-button">
                <i class="fas fa-plus-circle"></i>
            </button>

        </main>

        <div id="addStockModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="addStockForm"></div>
            </div>
        </div>

    <script src="dashboard.js"></script>
</body>
</html>
