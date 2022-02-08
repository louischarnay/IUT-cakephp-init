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
            <li>
                <?php
                if(isset($_SESSION['id'])): ?>
                    <a href="/decoTraitement.php">DECONNEXION</a>
                <?php else: ?>
                    <a href="/login.php">LOGIN</a>
                <?php endif ?>
            </li>
        </ul>
    </nav>
</div>