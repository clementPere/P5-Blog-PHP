
<?php 


foreach($articles as $article){
  echo '<br> '.$article->getTitre().' '. $article->getContenu();
};