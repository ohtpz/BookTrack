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
        <a href="/bibliotheque/addLivre/<?= $bibliotheque->idBiblio?>" class="btn btn-warning">Modifier livres</a>
    <?php endif; ?>
    <?php if (!empty($bibliotheque->livres)): ?>
        <ul class="list-group">
            <?php foreach ($bibliotheque->livres as $livre): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($livre['titre']) ?>
                    <div>
                        <a href="/livre/edit/<?= $livre['idLivre'] ?>" class="btn btn-sm btn-outline-secondary">Modifier</a>
                        <form method="POST" action="/livre/delete/<?= $livre['idLivre'] ?>" class="d-inline" onsubmit="return confirm('Supprimer ce livre ?')">
                            <button type="submit" class="btn btn-sm btn-outline-danger" >Supprimer</button>
                        </form>
                    </div>  
                </li>
            <?php endforeach; ?>
        </ul>
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