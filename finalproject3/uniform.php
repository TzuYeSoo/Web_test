<?php 
    require_once "connection.php";

    $sql = "SELECT uniform_name, uniform_quantity, uniform_price, uniform_part, program_name, uniform_status FROM uniforms as u
    INNER JOIN programs as p ON u.program_id = p.program_id";

    $result = mysqli_query($conn, $sql);
                            
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIFORM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="uniform.css">
    <link rel="stylesheet" href="style_newunif.css">

</head>
<body>
   <div class="backdrop" id="backdrop"></div>
    <!-- Modal for new uniform-->

    <div class="add-stock-container" id="stockin_modal">
        <div class="header_bg">
            <h2>UNIFORM</h2>
        </div>
        <form class="forms" method="post" action="query_insert_unif.php" enctype="multipart/form-data">

        <div class="form-grid">
            <div class="image-upload">
                <div class="image-placeholder"></div>
                <button>ADD IMAGE</button>
            </div>
           
            <div class="input-fields">
                <input type="text" placeholder="Uniform name" name="unif_name">
                <input type="text" placeholder="Uniform quantity" name="unif_quantity">
                <input type="text" placeholder="Uniform program" name="unif_program">
            </div>
            <div class="checkboxes">
                <div class="checkbox-column">
                    <label>
                        <input type="checkbox" class="item-check" data-target="polo-file" name="items[]" value="Polo"> Polo
                    </label>
                    <input type="file" id="polo-file" name="image_Polo" accept=".img, .png, .jpeg" disabled>

                    <label>
                        <input type="checkbox" class="item-check" data-target="pants-file" name="items[]" value="Pants"> Pants
                    </label>
                    <input type="file" id="pants-file" name="image_Pants" accept=".img, .png, .jpeg" disabled>
 
                    <label>
                        <input type="checkbox" class="item-check" data-target="necktie-file" name="items[]" value="Necktie"> Neck Tie
                    </label>
                    <input type="file" id="necktie-file" name="image_Necktie" accept=".img, .png, .jpeg" disabled>
                </div>
                <div class="checkbox-column">
                     <label>
                        <input type="checkbox" class="item-check" data-target="polo-file" name="items[]" value="Polo"> Polo
                    </label>
                    <input type="file" id="polo-file" name="image_Polo" accept=".img, .png, .jpeg" disabled>

                    <label>
                        <input type="checkbox" class="item-check" data-target="pants-file" name="items[]" value="Pants"> Pants
                    </label>
                    <input type="file" id="pants-file" name="image_Pants" accept=".img, .png, .jpeg" disabled>
 
                    <label>
                        <input type="checkbox" class="item-check" data-target="necktie-file" name="items[]" value="Necktie"> Neck Tie
                    </label>
                    <input type="file" id="necktie-file" name="image_Necktie" accept=".img, .png, .jpeg" disabled>
                </div>
            </div>
        </div>
        <div class="description-area">
            <textarea placeholder="Machime_description" name="unif_description"></textarea>
        </div>
        <div class="add-button-container">
            <input type="submit" class="add-button" value="ADD">
        </div>
        </form>
    </div>

    <!-- Modal for edit uniform -->

    <div class="add-stock-container" id="edit_unif">
        <div class="header_bg">
            <h2>UNIFORM</h2>
        </div>
        <form class="forms" method="post" action="query_edit_unif.php" enctype="multipart/form-data">

        <div class="form-grid">
            <div class="image-upload">
                <div class="image-placeholder"></div>
                <button>ADD IMAGE</button>
            </div>
           
            <div class="input-fields">
                <input type="text" placeholder="Uniform name" name="unif_name">
                <input type="text" placeholder="Uniform quantity" name="unif_quantity">
                <input type="text" placeholder="Uniform program" name="unif_program">
            </div>
            <div class="checkboxes">
                <div class="checkbox-column">
                    <label>
                        <input type="checkbox" class="item-check" data-target="polo-file" name="items[]" value="Polo"> Polo
                    </label>
                    <input type="file" id="polo-file" name="image_Polo" accept=".img, .png, .jpeg" disabled>

                    <label>
                        <input type="checkbox" class="item-check" data-target="pants-file" name="items[]" value="Pants"> Pants
                    </label>
                    <input type="file" id="pants-file" name="image_Pants" accept=".img, .png, .jpeg" disabled>
 
                    <label>
                        <input type="checkbox" class="item-check" data-target="necktie-file" name="items[]" value="Necktie"> Neck Tie
                    </label>
                    <input type="file" id="necktie-file" name="image_Necktie" accept=".img, .png, .jpeg" disabled>
                </div>
                <div class="checkbox-column">
                     <label>
                        <input type="checkbox" class="item-check" data-target="polo-file" name="items[]" value="Polo"> Polo
                    </label>
                    <input type="file" id="polo-file" name="image_Polo" accept=".img, .png, .jpeg" disabled>

                    <label>
                        <input type="checkbox" class="item-check" data-target="pants-file" name="items[]" value="Pants"> Pants
                    </label>
                    <input type="file" id="pants-file" name="image_Pants" accept=".img, .png, .jpeg" disabled>
 
                    <label>
                        <input type="checkbox" class="item-check" data-target="necktie-file" name="items[]" value="Necktie"> Neck Tie
                    </label>
                    <input type="file" id="necktie-file" name="image_Necktie" accept=".img, .png, .jpeg" disabled>
                </div>
            </div>
        </div>
        <div class="description-area">
            <textarea placeholder="Machime_description" name="unif_description"></textarea>
        </div>
        <div class="add-button-container">
            <input type="submit" class="add-button" value="EDIT">
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
                    <h1>Uniform</h1>
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
                            <th>Item name</th>
                            <th>price</th>
                            <th>quantity</th>
                            <th>part</th>
                            <th>program</th>
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
                                        <td><?php echo $row['uniform_name']?></td>
                                        <td><?php echo $row['uniform_quantity']?></td>
                                        <td><?php echo $row['uniform_price']?></td>
                                        <td><?php echo $row['uniform_part']?></td>
                                        <td><?php echo $row['program_name']?></td>
                                        <td><?php echo $row['uniform_status']?></td>
                                        <td>
                                            <i class="fas fa-pencil-alt"></i>
                                            <i class="fas fa-plus-circle" ></i>
                                        </td>
                                    </tr>
                                
                                <?php
                            }
                        ?>
                            
                    </tbody>
                </table>
            </div>

            <button class="add-item-button">
                <i class="fas fa-plus-circle" onclick="editModal()"></i>
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

    <script>
        document.querySelectorAll('.item-check').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const inputId = this.dataset.target;
            const fileInput = document.getElementById(inputId);

            if (this.checked) {
            fileInput.disabled = false;
            fileInput.setAttribute('required', 'required');
            } else {
            fileInput.disabled = true;
            fileInput.removeAttribute('required');
            }
        });
        });
    </script>

</body>
</html>
