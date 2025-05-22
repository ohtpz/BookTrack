<?php
//     var_dump($bibliotheque);
//     die();
?>
  
<div class="container mt-4">
    <h1>
        <?= htmlspecialchars($bibliotheque->nom) ?>
        <a href="" class="btn btn-sm btn-outline-primary ms-2">Modifier</a>
        <div id="">
            <form action="/bibliotheque/edit/<?= $bibliotheque->idBiblio?>" method="post">
                <input type="text" class="form-control form-control-sm" name="nom" value="<?= $bibliotheque->nom?>" minlength="3">
                <button type="submit" class="btn btn-sm btn-success mt-2">Enregistrer</button>  
            </form>
        </div>
        <form method="POST" action="/bibliotheque/delete/<?= $bibliotheque->idBiblio ?>" class="d-inline" onsubmit="return confirm('Supprimer cette bibliothèque ?')">
            <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
        </form>
    </h1>

    <hr>

    <h3>Livres</h3>
    <a href="/bibliotheque/addLivre/<?= $bibliotheque->idBiblio?>" class="btn btn-warning">Modifier livres</a>
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
