

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
      
    <!-- As a heading -->
    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1">Navbar</span>
    </nav>

    <div class="sidebar bg-white">
        <div class="sidebar-header">
            <button class="btn btn-sm btn-outline-primary">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>

        <div class="accordion" id="sidebarMenu">

            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#homeMenu">
                        Home 
                        <!-- Fetch the bibliotheques name -->
                    </button>
                </h2>
                <div id="homeMenu" class="accordion-collapse collapse show" data-bs-parent="#sidebarMenu">
                    <div class="accordion-body py-0">
                        <ul class="nav flex-column ms-3">
                            <!-- Fetch the books that are in that bibliotheque -->
                            <li class="nav-item"><a class="nav-link" href="#">Overview</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Updates</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                        </ul>
                    </div>
                </div>

                <?php
                    echo "";
                ?>
            </div>

            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardMenu">
                        Dashboard
                    </button>
                </h2>
                <div id="dashboardMenu" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">
                    <div class="accordion-body py-0">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#ordersMenu">
                        Orders
                    </button>
                </h2>
                <div id="ordersMenu" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">
                    <div class="accordion-body py-0">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">All Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#accountMenu">
                        Account
                    </button>
                </h2>
                <div id="accountMenu" class="accordion-collapse collapse" data-bs-parent="#sidebarMenu">
                    <div class="accordion-body py-0">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>
