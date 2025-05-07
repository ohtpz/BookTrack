<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
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
