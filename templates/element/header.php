<div id="menu">
    <nav>
        <ul>
            <li><a href="/index.php" <?php if($_SERVER["SCRIPT_NAME"] == "/index.php"){
                ?>class="active"
                    <?php } ?>>ACCUEIL</a></li>
            <?php
                echo '<li>'.$this->Html->link(
                    'LOGIN',
                    ['controller' => 'Users', 'action' => 'login', '_full' => true]
                ).'</li>';
                echo '<li>'.$this->Html->link(
                    'LOG OUT',
                    ['controller' => 'Users', 'action' => 'logout', '_full' => true]
                    ).'</li>';
                echo '<li>'.$this->Html->link(
                    'SIGN IN',
                    ['controller' => 'Users', 'action' => 'signin', '_full' => true]
                ).'</li>';?>
        </ul>
    </nav>
</div>
