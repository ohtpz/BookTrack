<div class="container mt-4">
    <div class="row g-4">
        <?php if (isset($livres) && !empty($livres)): ?>
            <?php foreach ($livres as $livre): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a href="/detail/<?= $livre->idLivre ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($livre->illustration)): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($livre->illustration) ?>"
                                     class="card-img-top"
                                     alt="<?= htmlspecialchars($livre->titre) ?>"
                                     style="height: 300px;">
                            <?php else: ?>
                                <img src="/img/default/defaultBook.jpg"
                                     class="card-img-top"
                                     alt="Pas d'image"
                                     style="height: 300px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($livre->titre) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($livre->auteur) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Aucun livre trouvé</p>
        <?php endif; ?>
    </div>
</div>
