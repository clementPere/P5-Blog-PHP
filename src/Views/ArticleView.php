<?php


foreach ($data as $article) {
    if ($article != null) {
        echo '<hr>Nom de la catégorie : ' . $article[1] . '<br> Référence de l\'article : ' . $article[2] . '</hr>';
    }
};
