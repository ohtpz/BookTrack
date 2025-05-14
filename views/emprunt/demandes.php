<div class="container mt-5">
    <h2 class="mb-4">Mes demandes</h2>

    <!-- Onglets -->
    <ul class="nav nav-tabs mb-4" id="demandesTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="recues-tab" data-bs-toggle="tab" data-bs-target="#recues" type="button" role="tab">Demandes reçues</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="envoyees-tab" data-bs-toggle="tab" data-bs-target="#envoyees" type="button" role="tab">Demandes envoyées</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="encours-tab" data-bs-toggle="tab" data-bs-target="#encours" type="button" role="tab">Emprunts en cours</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="historique-tab" data-bs-toggle="tab" data-bs-target="#historique" type="button" role="tab">Historique</button>
        </li>
    </ul>

    <!-- Contenu des onglets -->
    <div class="tab-content" id="demandesTabsContent">
        <!-- Reçues -->
        <div class="tab-pane fade show active" id="recues" role="tabpanel">
            <?php if (empty($demandesRecues)): ?>
                <p class="text-muted">Aucune demande reçue.</p>
            <?php else: ?>
                <div class="list-group">
                    <?php foreach ($demandesRecues as $d): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= htmlspecialchars($d['prenom'] . ' ' . $d['nom']) ?></strong>
                                veut emprunter <strong><?= htmlspecialchars($d['titre']) ?></strong> 
                                du <em><?= $d['dateDebut'] ?></em> au <em><?= $d['dateFin'] ?></em>.
                            </div>
                            <div>
                                <form method="post" action="/emprunt/accepter/<?= $d['idEmprunt'] ?>" class="d-inline">
                                    <button class="btn btn-success btn-sm">Accepter</button>
                                </form>
                                <form method="post" action="/emprunt/refuser/<?= $d['idEmprunt'] ?>" class="d-inline ms-2">
                                    <button class="btn btn-danger btn-sm">Refuser</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Envoyées -->
        <div class="tab-pane fade" id="envoyees" role="tabpanel">
            <?php if (empty($demandesEnvoyees)): ?>
                <p class="text-muted">Aucune demande envoyée.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($demandesEnvoyees as $d): ?>
                        <li class="list-group-item">
                            En attente : <strong><?= htmlspecialchars($d['titre']) ?></strong>
                            de <strong><?= htmlspecialchars($d['prenom'] . ' ' . $d['nom']) ?></strong>
                            (du <?= $d['dateDebut'] ?> au <?= $d['dateFin'] ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- En cours -->
        <div class="tab-pane fade" id="encours" role="tabpanel">
            <?php if (empty($empruntsEnCours)): ?>
                <p class="text-muted">Aucun emprunt en cours.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($empruntsEnCours as $e): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($e['titre']) ?></strong>
                            (du <?= $e['dateDebut'] ?> au <?= $e['dateFin'] ?>)
                            —
                            <?php if ($e['idEmprunteur'] == $_SESSION['user']['idUtilisateur']): ?>
                                avec <strong><?= htmlspecialchars($e['prenomProprio'] . ' ' . $e['nomProprio']) ?></strong> (propriétaire)
                            <?php else: ?>
                                pour <strong><?= htmlspecialchars($e['prenomEmp'] . ' ' . $e['nomEmp']) ?></strong> (emprunteur)
                            <?php endif; ?>
                            — <em><?= $e['statut'] ?></em>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Historique -->
        <div class="tab-pane fade" id="historique" role="tabpanel">
            <?php if (empty($historiqueRecues) && empty($historiqueEnvoyees)): ?>
                <p class="text-muted">Aucune demande historique.</p>
            <?php else: ?>
                <h5 class="mt-3">Demandes reçues (traitées)</h5>
                <ul class="list-group mb-3">
                    <?php foreach ($historiqueRecues as $d): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($d['prenom'] . ' ' . $d['nom']) ?></strong>
                            a demandé <strong><?= htmlspecialchars($d['titre']) ?></strong>
                            (du <?= $d['dateDebut'] ?> au <?= $d['dateFin'] ?>)
                            — <em><?= htmlspecialchars($d['statut']) ?></em>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <h5 class="mt-3">Demandes envoyées (traitées)</h5>
                <ul class="list-group">
                    <?php foreach ($historiqueEnvoyees as $d): ?>
                        <li class="list-group-item">
                            Pour <strong><?= htmlspecialchars($d['titre']) ?></strong> de <strong><?= htmlspecialchars($d['prenom'] . ' ' . $d['nom']) ?></strong>
                            (du <?= $d['dateDebut'] ?> au <?= $d['dateFin'] ?>)
                            — <em><?= htmlspecialchars($d['statut']) ?></em>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
