<div class="detail">
    <img src="<?= isset($livre->illustration) ? 'data:image/jpeg;base64,' . base64_encode($livre->illustration) : '/img/default/defaultBook.jpg' ?>" alt="">
    <div>
        <a href="/emprunt/{idLivre}" class="btn btn-primary">Louer</a>
        <h1>Titre</h1>
        <h3><?= $livre->titre ?></h3>
        <p><h1>rating</h1>
        <?php
            $total = 0;

            foreach ($ratings as $rating) {
                $total += $rating->note;
            }

            if ($total == 0)
                echo 0;

            echo intdiv($total * 10, count($ratings)) / 10;     
            // $rating / 10
            ?>/5</p>
            <h2>Description</h2>
            <p><?= $livre->description ?></p>
    </div>

    
    <div class="comments">
        <?php
        foreach ($ratings as $rating) {
            $userName = null;
            foreach ($users as $user) {
                if ($user->getIdUtilisateur() == $rating->idUtilisateur)
                    $userName = $user->getNom() . " " . $user->getPrenom();
            }
            echo '<div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $userName . '</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">' . $rating->note . '</h6>
                        <p class="card-text">' . $rating->commentaire . '</p>
                        <p class="card-text"><small class="text-body-secondary">Le : ' . explode(" ", $rating->date)[0] . '</small></p>
                    </div>
                </div>';
        }
        ?>

        <form action='/detail/<?= $livre->idLivre?>/addComment' method="post">
            <input type="checkbox" name="rating[]" id="" checked class="fa fa-star checked">
            <input type="checkbox" name="rating[]" id="" class="fa fa-star">
            <input type="checkbox" name="rating[]" id="" class="fa fa-star">
            <input type="checkbox" name="rating[]" id="" class="fa fa-star">
            <input type="checkbox" name="rating[]" id="" class="fa fa-star">
            <input type="text" aria-multiline="true" class="form-control" name="comment">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div><br>
</div>
<script>
    let boxes = document.getElementsByName("rating[]");

    boxes.forEach(box => {
        box.onclick = function(event) {
            let isChecked = false;

            boxes.forEach(box =>{
                if(!isChecked) {
                    if(box == event.currentTarget)
                        isChecked = true;
                        
                    box.checked = true;                    
                }
                else
                    box.checked = false;                    
                    
            })
        }
    });
</script>