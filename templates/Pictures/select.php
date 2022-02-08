<?php $this->assign('title', $exif[$image->name]['name']) ?>
<h2><?= $exif[$image->name]['name'] ?></h2>
<?= $exif[$image->name]['html'] ?>
<p>Description : <?= $exif[$image->name]['description'] ?></p>
<p>Comment : <?= $exif[$image->name]['comment'] ?></p>
<p>Author : <?= $exif[$image->name]['author'] ?></p>
<p>Width : <?= $exif[$image->name]['width'] ?></p>
<p>Height : <?= $exif[$image->name]['height'] ?></p>
<?php $root = 'http://projetcakephp.test/img/imgAPI/' . $exif[$image->name]['name'] ?>
<a href=<?=$root?> download=<?= $exif[$image->name]['name'] ?>>Télécharger l'image</a>
<h2>Commentaires :</h2>
<?php
    $cpt = 0;
    foreach ($comments[$image->name] as $comment){
        echo '<p>N°' . $cpt . ' : ' . $comment;
    }