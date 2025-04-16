<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Inscription</h1>
                    <form method="post" action="/register" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageProfil" class="form-label">Photo de profil (optionnelle)</label>
                            <input type="file" class="form-control" id="imageProfil" name="imageProfil" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Créer un compte</button>
                    </form>

                    <?php if (!empty($_GET['error'])): ?>
                        <div class="alert alert-danger mt-3"><?= htmlspecialchars($_GET['error']) ?></div>
                    <?php endif; ?>

                    <p class="mt-4 text-center">
                        Déjà un compte ?
                        <a href="/login" class="text-decoration-none">Connectez-vous</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+k0TPsSUHmrqQEZBJ5EYXPLkZXl2b7xvFeoJEB6Digw1k3D6Z0fjQX+0Gooy2V" crossorigin="anonymous"></script>
</body>
</html>
