<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Demande d'emprunt</h2>

                    <?php if (!empty($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            <?php
                                switch ($_GET['error']) {
                                    case 'dates':
                                        echo "La date de début doit être avant la date de fin.";
                                        break;
                                    case 'passee':
                                        echo "La date de début ne peut pas être dans le passé.";
                                        break;
                                    case 'doublon':
                                        echo "Vous avez déjà une demande en attente ou en cours pour ce livre avec ce propriétaire.";
                                        break;
                                    case 'recouvrement':
                                        echo "Ce livre est déjà emprunté pendant cette période.";
                                        break;
                                    default:
                                        echo "Erreur inconnue.";
                                }
                            ?>
                        </div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="mb-3">
                            <label for="dateDebut" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                        </div>

                        <div class="mb-3">
                            <label for="dateFin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Voir les propriétaires</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
