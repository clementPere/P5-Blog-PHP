<h1>Bonsoir</h1>

<?php foreach($articles as $article){
  echo '<br> '.$article->getTitre().' '. $article->getContenu();
};