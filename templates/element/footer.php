<?php //include_once __DIR__."/../include/config.php"?>
<footer>
    <?=$this->Html->image('logoUCBL.png', ['alt' => 'Logo Université Claude Bernard Lyon 1', 'id' => 'logoUCBL']) ?>
    <div id="footerP">
        <p>Copyright © Pablo Guinard - Louis Charnay 2021</p>
        <p>Tous droits d'auteur réservés</p>
    </div>
    <div id="footerA">
        <a href="contact.php">Contact</a>
        <a href="index.php">Présentation</a>
        <?php
            //$db = new db();
            //$lastArticle = $db->getLastsArticles(false);
        ?>
        <a href="blog.php?article=<?php //echo $lastArticle['id'] ?>" class="sousMenuArticle">Article récent</a>
    </div>
</footer>
