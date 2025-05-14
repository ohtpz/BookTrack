<div>
    <?php
        if(isset($livres) && $livres != null) {
            foreach($livres as $livre) {
                echo '<a href="/detail/'.$livre->idLivre.'">
                        <div class="card" style="width: 18rem;">
                            <img src="data:image/jpeg;base64,'.base64_encode($livre->illustration).'"/>' .'
                            <div class="card-body">
                                <p class="card-text">'
                                .$livre->titre. "<br>"
                                .$livre->auteur.
                                '</p>
                            </div>
                        </div>
                      </a> <br>';
            }
        } 
        else
            echo "Aucun livre trouvé";
    ?>
    
</div>