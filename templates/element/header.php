<div id="menu">
    <nav>
        <ul>
            <li><a href="/index.php" <?php if($_SERVER["SCRIPT_NAME"] == "/index.php"){
                ?>class="active"
                    <?php } ?>>ACCUEIL</a></li>
            <li><a href="/contact.php" <?php if($_SERVER["SCRIPT_NAME"] == "/contact.php"){
                ?>class="active"
                    <?php } ?>>CONTACT</a></li>
            <li><a href="/inscription.php" <?php if($_SERVER["SCRIPT_NAME"] == "/inscription.php"){
                ?>class="active"
                    <?php } ?>>INSCRIPTION</a></li>
            <?php
                echo '<li>'.$this->Html->link(
                    'LOG OUT',
                    ['controller' => 'Users', 'action' => 'logout', '_full' => true]
                    ).'</li>';
                echo '<li>'.$this->Html->link(
                    'LOGIN',
                    ['controller' => 'Users', 'action' => 'login', '_full' => true]
                ).'</li>';
                echo '<li>'.$this->Html->link(
                    'SIGN IN',
                    ['controller' => 'Users', 'action' => 'signin', '_full' => true]
                ).'</li>';?>
        </ul>
    </nav>
</div>
