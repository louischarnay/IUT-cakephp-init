<?php $this->assign('title', $exif[$image]['name']) ?>
<h1><?= $exif[$image]['name'] ?></h1>
<?= $exif[$image]['html'] ?>
<p>Description : <?= $exif[$image]['description'] ?></p>
<p>Comment : <?= $exif[$image]['comment'] ?></p>
<p>Author : <?= $exif[$image]['author'] ?></p>
<p>Width : <?= $exif[$image]['width'] ?></p>
<p>Height : <?= $exif[$image]['height'] ?></p>
    <a href='http://projetcakephp.test/img/'.<?= $exif[$image]['name'] ?> download=<?= $exif[$image]['name'] ?>>Télécharger l'image</a>