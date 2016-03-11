<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand title" href="./">Administration</a>
            <a class="navbar-brand " href="./">
            <a class="navbar-brand" href="../../app/view/objets.php">Objets</a>
            <?php
                if(isset($_SESSION['user'])) {
                    echo '<a class="navbar-brand " href="../../app/model/deconnect.php">Déconnection</a>';
                }
            ?>
            <span class="glyphicon glyphicon-off" href="./"></span>
        </div>
    </div>
</nav>