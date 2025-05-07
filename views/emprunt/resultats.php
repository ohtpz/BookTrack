<div class="container mt-4">
    <h2 class="mb-4">Propriétaires disponibles</h2>

    <p class="lead">
        Demande d'emprunt du 
        <strong><?= htmlspecialchars($dateDebut) ?></strong> 
        au 
        <strong><?= htmlspecialchars($dateFin) ?></strong>
    </p>

    <?php if (empty($utilisateurs)): ?>
        <div class="alert alert-warning">Aucun propriétaire trouvé pour ce livre.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($utilisateurs as $user): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?= htmlspecialchars($user['imageProfil']) ?>" 
                                     alt="Profil" 
                                     class="rounded-circle me-3" 
                                     width="60" 
                                     height="60">
                                <div>
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></h5>
                                    <small class="text-muted"><?= htmlspecialchars($user['email']) ?></small>
                                </div>
                            </div>

                            <form method="post" action="/emprunt/demande">
                                <input type="hidden" name="idLivre" value="<?= $idLivre ?>">
                                <input type="hidden" name="idProprietaire" value="<?= $user['idUtilisateur'] ?>">
                                <input type="hidden" name="dateDebut" value="<?= $dateDebut ?>">
                                <input type="hidden" name="dateFin" value="<?= $dateFin ?>">
                                <button class="btn btn-success w-100">Faire la demande</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
