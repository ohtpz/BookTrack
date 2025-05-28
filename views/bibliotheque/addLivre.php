<div class="container mt-4">
    <form method="post" action="/addToLibrary">
        <div class="row g-4">
            <?php foreach ($livres as $livre): ?>
                <div class="col-md-4">  
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="livres[]" value="<?= htmlspecialchars($livre->idLivre) ?>" id="livre-<?= htmlspecialchars($livre->idLivre) ?>">
                        <label class="form-check-label d-flex" for="livre-<?= htmlspecialchars($livre->idLivre) ?>">
                            <?= htmlspecialchars($livre->titre) ?>
                            <img src="/img/default/defaultBook.jpg" alt="" width="100" height="100" class="ms-2">
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>