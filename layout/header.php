<header>
    <div>
        <a href="index.php">Reservasi list</a>
    </div>
    <div>
        <?php
            if(isset($_SESSION['is_login'])) {
                echo "<a href='logout.php'>logout</a>";
                echo "<a href='report.php'>report</a>";
            }else {
                echo "<a href='login.php'>login</a>";
            }
        ?>
    </div>
</header>