<?php
use Elpommier\BookTrack\models\Bibliotheque;
use Elpommier\BookTrack\models\User;

$user = null;
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $user->connect();
    $listBibliotheques = Bibliotheque::fetchBibliothequesByUserId($user->getIdUtilisateur());
} else {
    $listBibliotheques = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'BookTrack') ?></title>
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!-- Own CSS -->
    <link rel="stylesheet" href="/css/style.css">

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
                                <a class="nav-link" href="#">Bonjour, <?= htmlspecialchars($_SESSION['user']->getPrenom()) ?></a>
                                <a class="nav-link" href="/emprunt/mes-demandes">Demandes</a>
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
            <div class="sidebar-header flex-column align-items-start">
                <button id="addLibraryButton" class="btn btn-sm btn-outline-primary mb-2">
                    <i class="bi bi-plus-lg"></i>
                </button>

                <form method="POST" action="/bibliotheque/add" class="w-100 d-flex align-items-center gap-2" style="display: none;" id="libraryInputContainer">
                    <input type="text" class="form-control form-control-sm" name="nom" placeholder="Nom de la bibliothèque" minlength="3" required>
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="bi bi-check-lg"></i>
                    </button>
                </form>
            </div>  


            <div class="accordion" id="sidebarMenu">



                <?php 
                if($listBibliotheques):
                 foreach ($listBibliotheques as $biblio): ?>
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed px-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#biblioMenu<?= $biblio->idBiblio ?>">
                                <?= htmlspecialchars($biblio->nom) ?>
                            </button>
                        </h2>
                        <div id="biblioMenu<?= $biblio->idBiblio ?>" class="accordion-collapse collapse">
                            <div class="accordion-body py-0">
                                <ul class="nav flex-column ms-3">
                                <?php if (!empty($biblio->livres)): ?>
                                    <?php foreach ($biblio->livres as $livre): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                <?= htmlspecialchars($livre['titre'] ?? 'Sans titre') ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="nav-item">
                                        <span class="nav-link text-muted">Aucun livre</span>
                                    </li>
                                <?php endif; ?>
                                </ul>                                
                            </div>
                        </div>
                    </div>
                <?php 
             endforeach;
            endif; ?>
            

            </div>
        </div>

        <main class="container py-4 flex-grow-1">
            <?= $content ?>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('addLibraryButton');
        const form = document.getElementById('libraryInputContainer');

        btn.addEventListener('click', () => {
            form.style.display = form.style.display === 'none' ? 'flex' : 'none';
        });
    });
</script>

</body>
</html>