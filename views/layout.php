<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'BookTrack') ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            border-right: 1px solid #dee2e6;
            padding: 1rem;
        }
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .nav-link {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">BookTrack</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/conv">Conv</a>
                        </li>
                        <?php if (!empty($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Bonjour, <?= htmlspecialchars($_SESSION['user']['prenom']) ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="/logout">Déconnexion</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register">Inscription</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="d-flex">
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
                        </button>
                    </h2>
                    <div id="homeMenu" class="accordion-collapse collapse">
                        <div class="accordion-body py-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item"><a class="nav-link" href="#">Overview</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Updates</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardMenu">
                            Dashboard
                        </button>
                    </h2>
                    <div id="dashboardMenu" class="accordion-collapse collapse">
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
                    <div id="ordersMenu" class="accordion-collapse collapse">
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
                    <div id="accountMenu" class="accordion-collapse collapse">
                        <div class="accordion-body py-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <main class="container py-4 flex-grow-1">
            <?= $content ?>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
