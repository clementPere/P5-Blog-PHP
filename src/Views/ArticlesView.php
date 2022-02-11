
<?php


foreach ($data as $article) {
  if ($article != null) {
    echo '<hr>Titre de l\'article : ' . $article[1] . '<br> Contenue de l\'article : ' . $article[2] . '</hr>';
  }
};

?>