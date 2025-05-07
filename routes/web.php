<?php

use Elpommier\BookTrack\controllers\BaseController;
use Elpommier\BookTrack\controllers\LivreController;

$app->get("/", [LivreController::class, "getBooks"]);