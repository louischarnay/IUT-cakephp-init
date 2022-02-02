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
?>

<!DOCTYPE html>
<html lang="fr">
    <head>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php 
            $this->fetch('title');
            $this->Html->css(['style'])
        ?>
    </head>
    <body class="body">
        <header class="header">
            <?php 
                $this->element('banner');
                $this->element('navbar');            
            ?>
        </header>
        <main class="main"> </main>
        <?php 
            $this->element('footer');
            $this->Html->script('script');
            $this->Html->script('transitions');
        ?>
    </body>
</html>