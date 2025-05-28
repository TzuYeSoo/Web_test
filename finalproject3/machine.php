<?php 
    require_once "connection.php";

    $sql = "SELECT machine_name, machine_type, machine_quantity, machine_room_no, machine_status FROM machine";

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
    <link rel="stylesheet" href="style_newmachine.css">

</head>
<body>


<div class="backdrop" id="backdrop"></div>
    <!-- Modal for stock in-->

    <div class="add-stock-container" id="stockin_modal">
        <div class="header_bg">
            <h2>UNIFORM</h2>
        </div>
        <form class="forms" method="post" action="query_insert_machine.php" enctype="multipart/form-data">

        <div class="form-grid">
            <div class="input-fields">
                <input type="text" placeholder="Machine name" name="machine_name">
                <input type="text" placeholder="Machine type" name="machine_type">
                <input type="text" placeholder="Room Number" name="machine_room_no">
                <input type="text" placeholder="Machine unique_id" name="machine_unique_id">
                <input type="text" placeholder="Machine quantity" name="machine_quantity">
            </div>
        </div>
        <div class="add-button-container">
            <input type="submit" class="add-button" value="ADD">
        </div>
        </form>
    </div>


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
                    <h1>Machine</h1>
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
                            <th>Machine name</th>
                            <th>Machine Type</th>
                            <th>quantity</th>
                            <th>Room number</th>
                            <th>Status</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            while($row=mysqli_fetch_assoc($result)){

                                ?> 
                                    <tr>
                                        <td><?php echo $row['machine_name']?></td>
                                        <td><?php echo $row['machine_type']?></td>
                                        <td><?php echo $row['machine_quantity']?></td>
                                        <td><?php echo $row['machine_room_no']?></td>
                                        <td><?php echo $row['machine_status']?></td>
                                        <td>
                                            <i class="fas fa-pencil-alt"></i>
                                            <i class="fas fa-plus-circle"></i>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>

                    </tbody>
                </table>
            </div>

            <button class="add-item-button" onclick="editModal()">
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
    <script src="uniform.js"></script>
</body>
</html>
