document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.getElementById('sidebar');
    const dropdown = document.querySelector('.dropdown');
    

    // Toggle sidebar on hamburger click
    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
    });

    // Toggle dropdown on click
    dropdown.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent event from bubbling up
        dropdown.classList.toggle('active');
    });
    
    // Optional: Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768 && 
            !sidebar.contains(event.target) && 
            !hamburger.contains(event.target) && 
            sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });

    // Handle window resize (optional - adjust if sidebar behavior changes on resize)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active'); // Or handle differently based on design
             sidebar.classList.remove('collapsed'); // Ensure it's not collapsed on wider screens if design requires
        }
    });

    // Modal functionality for Add Stock
    const addStockModal = document.getElementById('addStockModal');
    const addStockBtn = document.querySelector('.inventory-table th .fa-plus-circle');
    const closeBtn = addStockModal.querySelector('.close');
    const addStockFormDiv = document.getElementById('addStockForm');

    // Open the modal when the plus icon in the table header is clicked
    if (addStockBtn) {
        addStockBtn.parentElement.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            fetch('add_stock.html')
                .then(response => response.text())
                .then(html => {
                    addStockFormDiv.innerHTML = html;
                    addStockModal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching add_stock.html:', error);
                    // Optionally display an error message in the modal or console
                });
        });
    }

    // Close the modal when the close button is clicked
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            addStockModal.style.display = 'none';
            addStockFormDiv.innerHTML = ''; // Clear content when closing
        });
    }

    // Close the modal when the user clicks outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target == addStockModal) {
            addStockModal.style.display = 'none';
            addStockFormDiv.innerHTML = ''; // Clear content when closing
        }
    });
}); 