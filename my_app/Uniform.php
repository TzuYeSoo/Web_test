<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniform</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="uniform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class='backdrop' id="backdrop"></div>

    <!-- Modal for stock in-->
    <div class="stock-modal" id="stockModal">
        <div class="modal-header">
            <span class="modal-title">Stock In</span>
            <span class="modal-close" onclick="removemodal_stock()">×</span>
        </div>
        <div class="modal-body">
            <form>
                <div>
                    <h1 id="unif_name"></h1>
                </div>

                <div>
                    <input type="text" placeholder="current stock" id="currentstock">
                </div>

                <div>
                    <input type="text" placeholder="added stock">
                </div>

                <div>
                    <input type="text" placeholder="Date & time">
                </div>
                
                <div>
                    <select>
                        <option disabled selected>Supplier</option>
                        <option>Supplier A</option>
                        <option>Supplier B</option>
                    </select>
                </div>
                
                <button class="add-btn">ADD</button>
            </form>
        </div>
    </div>
    <!-- Modal for adding new uniform-->
    <div class="clothes-modal" id="clothesModal">
    <div class="modal-header">
        <span class="modal-title">UNIFORM</span>
        <span class="modal-close" onclick="removemodal_unif()">×</span>
    </div>

    <div class="modal-content">
        <div class="left-section">
            <!-- Image Preview -->
        <img id="image-placeholder" class="image-placeholder" src="" alt="Image Preview" width="200" />

        <!-- File Input -->
        <input type="file" id="imageInput" accept=".png, .jpg, .jpeg, .img" class="image-btn" />

        <!-- JavaScript -->
        <script>
            const imageInput = document.getElementById('imageInput');
            const chosenImage = document.getElementById('image-placeholder');

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        chosenImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
            <input type="text" placeholder="Machine_name">
            <input type="text" placeholder="Machine_quantity">
            <input type="text" placeholder="Machine_type">
        </div>

        <div class="right-section">
            <div class="checkbox-group">
                <label><input type="checkbox"> Blouse</label>
                <label><input type="checkbox"> Polo</label>
                <label><input type="checkbox"> Blazer</label>
                <label><input type="checkbox"> Pants</label>
                <label><input type="checkbox"> Blouse</label>
                <label><input type="checkbox"> Polo</label>
                <label><input type="checkbox"> Blazer</label>
                <label><input type="checkbox"> Pants</label>
            </div>
        </div>
    </div>

        <textarea placeholder="Machine_description"></textarea>
        <button class="add-btn">ADD</button>
    </div>

    <div class="container">
        <nav class="sidebar" id="sidebar">
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
            <div class="nav-items">
                <a href="dashbord.html" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <div class="nav-item dropdown">
                    <button class="dropdown-header">
                        <i class="fas fa-box"></i>
                        <span>Inventory</span>
                        <i class="fas fa-chevron-down arrow"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-tshirt"></i>
                            <span>Uniform</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Machine</span>
                        </a>
                        
                    </div>
                </div>
                <a href="#" class="nav-item">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Borrow</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="far fa-calendar-alt"></i>
                    <span>Reservation</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-truck"></i>
                    <span>Supplier</span>
                </a>
                <a href="#" class="nav-item logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>

        <main class="main-content">
            <header>
                <div class="logo-section">
                    <img src="stilogo.png" alt="STI Logo" class="logo">
                    
                </div>
                <div class="user-account">
                    <img src="alden.png" alt="User" class="avatar">
                    <span>user account</span>
                </div>
            </header>

            <div class="content">
                <h2>Uniform</h2>
                <div class="filters">
                    <select id="programSelect">
                        <option action="inter_user.php" method="post">Program</option>
                        <option>BSIT</option>
                        <option>BSBA</option>
                    </select>
                    <select id="sizeSelect">
                        <option>Size</option>
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                    </select>
                    <select id="partSelect">
                        <option>Clothes part</option>
                        <option>Shirt</option>
                        <option>Pants</option>
                        <option>Jacket</option>
                    </select>
                </div>
                <div class="uniform-table-container">
                    <table class="uniform-table">
                        <thead>
                            <tr>
                                <th>Item name</th>
                                <th>price</th>
                                <th>quantity</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="uniformTableBody">
                            
                                <?php 
                                require_once 'connection.php';

                                $query = "SELECT * FROM user_account";
                                $result = $conn->query($query);

                                if (!$result) {
                                    die("Invalid items: " . $conn->error);
                                }

                                while ($rows = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                        <td>{$rows['user_id']}</td>
                                        <td>{$rows['firt_name']}</td>
                                        <td>{$rows['last_name']}</td>
                                        <td>{$rows['position']}</td>
                                        <td>
                                            <i class='fas fa-edit action-icon' onclick='openEditModal({$rows['user_id']})' title='Edit'></i>
                                            <i class='fas fa-plus-circle action-icon'onclick='editModal({$rows['user_id']}, 
                                                                                                        \"{$rows['firt_name']}\", 
                                                                                                        \"{$rows['last_name']}\")' 
                                            title='Add'></i>
                                        </td>
                                    </tr>";
                                }
                                ?>

                            
                        </tbody>
                    </table>
                    <button class="add-row-btn" id="createUnif"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </main>
    </div>
    <script src="dashboard.js"></script>
    <script src="uniform_modal.js"></script>
</body>
</html>