<div class="detail">
    <img src="data:image/jpeg;base64,<?= isset($livre->illustration)?base64_encode($livre->illustration) : "defaultBook.jpg"?>" alt="">
    <div>
        <a href="" class="btn btn-primary">Louer</a>
        <h1>Titre</h1>
        <h3><?= $livre->titre?></h3>
    </div>
    <div>
        <h2>Description</h2>
        <p><?= $livre->description?></p>
    </div>
</div>  