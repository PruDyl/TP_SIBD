<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <h1></h1><a class="navbar-brand title" href="./"><span class="glyphicon glyphicon-wrench"</span>
                ADMINISTRATION</a></h1>
            <?php
            if (isset($_SESSION['user'])) {
                echo '<h2><a class="navbar-brand" href="index.php?page=objets">Objets</a></h2>';
                echo '<h2><a class="navbar-brand" href="../../app/model/deconnect.php">Déconnection</a></h2>';
            }
            ?>
        </div>
    </div>
</nav>