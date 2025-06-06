<div class="container mt-4">
    <h1 id="bibliothequeName"><?= htmlspecialchars($bibliotheque->nom) ?></h1>
        <?php if($user && $user->isMemberOfBibliotheque($bibliotheque->idBiblio)): ?>
            <button id="editButton" class="btn btn-sm btn-outline-primary ms-2">Modifier</button>
            <div id="editForm" style="display: none;">
                <form action="/bibliotheque/edit/<?= $bibliotheque->idBiblio ?>" method="post">
                    <input type="text" id="bibliothequeInput" class="form-control form-control-sm" name="nom" value="<?= htmlspecialchars($bibliotheque->nom) ?>" minlength="3">
                    <button type="submit" class="btn btn-sm btn-success mt-2">Enregistrer</button>
                    <button type="button" id="cancelButton" class="btn btn-sm btn-secondary mt-2">Annuler</button>
                </form>
            </div>
            <form method="POST" action="/bibliotheque/delete/<?= $bibliotheque->idBiblio ?>" class="d-inline" onsubmit="return confirm('Supprimer cette bibliothèque ?')">
                <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
            </form>
            
        <?php endif; ?>

    <hr>     

    <h3>Livres</h3>
    <?php if($user && $user->isMemberOfBibliotheque($bibliotheque->idBiblio)):    ?>
        <a href="/bibliotheque/addLivre/<?= $bibliotheque->idBiblio?>" class="btn btn-warning mb-3 ">Modifier livres</a>
    <?php endif; ?>
    <?php if (!empty($bibliotheque->livres)): ?>
        
        <div class="row">
            <?php foreach ($bibliotheque->livres as $livre): ?>
                <div class="col-md-4 mb-4">  
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="form-check d-flex align-items-center">
                                <label class="form-check-label d-flex flex-grow-1 justify-content-between align-items-center" for="livre-<?= htmlspecialchars($livre['idLivre']) ?>">
                                    <div class="d-flex flex-column">
                                        <span><?= htmlspecialchars($livre['titre']) ?></span>
                                        <span class="text-muted"><?= htmlspecialchars($livre['auteur']) ?></span>
                                    </div>
                                    <img src="<?= isset($livre['illustration']) ? 'data:image/jpeg;base64,' . base64_encode($livre['illustration']) : '/img/default/defaultBook.jpg' ?>" alt="" width="140" height="200" class="ms-2">
                                </label>
                            </div>
                            <div class="mt-auto text-center">
                                <a href="/detail/<?= $livre['idLivre'] ?>" class="btn btn-sm btn-primary ">Voir</a>
                                <form method="POST" action="/deleteBiblioLivre" class="d-inline" onsubmit="return confirm('Supprimer ce livre ?')">
                                    <input type="hidden" name="idLivre" value="<?= $livre['idLivre'] ?>">
                                    <input type="hidden" name="idBiblio" value="<?= $bibliotheque->idBiblio ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Aucun livre dans cette bibliothèque.</p>
    <?php endif; ?>
</div>
<script>
document.getElementById('editButton').addEventListener('click', function() {
    const editForm = document.getElementById('editForm');
    const editButton = document.getElementById('editButton');
    const bibliothequeName = document.getElementById('bibliothequeName');
    const bibliothequeInput = document.getElementById('bibliothequeInput');
    
    editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
    editButton.style.display = editForm.style.display === 'block' ? 'none' : 'inline-block';
    bibliothequeName.style.display = editForm.style.display === 'block' ? 'none' : 'block';
    bibliothequeInput.value = bibliothequeName.textContent.trim();
});

document.getElementById('cancelButton').addEventListener('click', function() {
    const editForm = document.getElementById('editForm');
    const editButton = document.getElementById('editButton');
    const bibliothequeName = document.getElementById('bibliothequeName');
    
    editForm.style.display = 'none';
    editButton.style.display = 'inline-block';
    bibliothequeName.style.display = 'block';
});
</script>