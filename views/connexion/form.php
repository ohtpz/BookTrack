<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Connexion</h1>
                    <form method="post" action="/login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Connexion</button>
                    </form>

                    <?php if (!empty($_GET['error'])): ?>
                        <div class="alert alert-danger mt-3">Identifiants incorrects</div>
                    <?php endif; ?>

                    <p class="mt-4 text-center">
                        Pas encore de compte ? <a href="/register" class="text-decoration-none">Créez-en un</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
