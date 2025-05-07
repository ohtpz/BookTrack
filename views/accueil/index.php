<div>
    <?php
        if(isset($livres) && $livres != null) {
            foreach($livres as $livre) {
                echo $livre->titre . '<img src="data:image/jpeg;base64,'.base64_encode($livre->illustration).'"/>' .' <br>';
            }
        } 
        else
            echo "Aucun livre trouvé";
    ?>
</div>