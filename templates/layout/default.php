<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>  
        <meta charset="UTF-8">
        <Title>Title</Title>
    </head>
    <body class="body">
        <header class="header">
            <?php 
                $this->fetch('banner');
                $this->fetch('header');            
            ?>
        </header>
        <main class="main">

        </main>
        <footer class="footer">
            <?php $this->fetch('footer'); ?>
        </footer>
    </body>
</html>