<?php $this->assign('title', $exif[$image]['name']) ?>
<h1><?= $exif[$image]['name'] ?></h1>
<?= $exif[$image]['html'] ?>
<p>Description : <?= $exif[$image]['description'] ?></p>
<p>Comment : <?= $exif[$image]['comment'] ?></p>
<p>Author : <?= $exif[$image]['author'] ?></p>
<p>Width : <?= $exif[$image]['width'] ?></p>
<p>Height : <?= $exif[$image]['height'] ?></p>
<?php $root = 'http://projetcakephp.test/img/imgAPI/' . $exif[$image]['name'] ?>
<a href=<?=$root?> download=<?= $exif[$image]['name'] ?>>Télécharger l'image</a>