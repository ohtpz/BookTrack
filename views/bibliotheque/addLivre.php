<div class="container mt-4">
    <form method="post" action="/bibliotheque/addLivre/<?= $bibliotheque->idBiblio ?>">
        <div class="row g-4">
            <?php foreach ($livres as $livre): ?>
                <div class="col-md-4">  
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="checkbox" name="livres[]" value="<?= htmlspecialchars($livre->idLivre) ?>" id="livre-<?= htmlspecialchars($livre->idLivre) ?>" <?php foreach($livresInBiblio as $livreInBiblio) {
                                    if ($livreInBiblio->idLivre === $livre->idLivre) {
                                        echo 'checked';
                                        break;
                                    }
                                }?> >
                                <label class="form-check-label d-flex flex-grow-1 justify-content-between align-items-center" for="livre-<?= htmlspecialchars($livre->idLivre) ?>">
                                    <div class="d-flex flex-column ps-3">
                                        <span><?= htmlspecialchars($livre->titre) ?></span>
                                        <span class="text-muted"><?= htmlspecialchars($livre->auteur) ?></span>
                                    </div>
                                    <img src="<?= isset($livre->illustration) ? 'data:image/jpeg;base64,' . base64_encode($livre->illustration) : '/img/default/defaultBook.jpg' ?>" alt="" width="140" height="200" class="ms-2">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="submit" value="Enregistrer les changements" class="btn btn-primary mt-3">
    </form>
</div>