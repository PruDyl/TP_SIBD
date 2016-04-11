<section>
<div class="page-header">
<h3>Tables</h3>
<?php
if (isset($_GET['table'])) {
	echo '<a class="btn btn-link" href="index.php?page=objets">Retour</a>';
	$appModel = new AppModel();
	
	if ($_GET['table'] == "Centre_equestre")
		$row = $appModel->getCentreEquestre($_GET['id']);
	elseif ($_GET['table'] == "Cheval")
		$row = $appModel->getCheval($_GET['id']);
	elseif ($_GET['table'] == "Club_hippique")
		$row = $appModel->getClubHippique($_GET['id']);
	elseif ($_GET['table'] == "Concours")
		$row = $appModel->getConcours($_GET['id']);
	elseif ($_GET['table'] == "Infrastructure")
		$row = $appModel->getInfrastructure($_GET['id']);
	elseif ($_GET['table'] == "Item")
		$row = $appModel->getItem($_GET['id']);
	elseif ($_GET['table'] == "Item_concours")
		$row = $appModel->getItemConcours($_GET['id']);
	elseif ($_GET['table'] == "Joueur")
		$row = $appModel->getJoueur($_GET['id']);
	elseif ($_GET['table'] == "Journal")
		$row = $appModel->getJournal($_GET['id']);
	elseif ($_GET['table'] == "Tache")
		$row = $appModel->getTache($_GET['id']);
	else 
		echo '<label name="error">Table invalide</label>';
}
?>

    </div>
    <div class="row" id="dataZone">
        <div class="col-md-12">
            <form id="modif" name="modif" action="">
            	<?php 
            	//print_r($params); 
            	$cpt = 0;
            	foreach ($params as $column) { ?>
            		<div class="input-group input-group-sm">
            			<span class="input-group-addon" id="sizing-addon2"><?php echo $column[0]; ?></span>
            			<input type="text" name="<?php echo $column[0]; ?>" id="<?php echo $column[0]; ?>" value="<?php echo $row[0][$cpt]; ?>">
					</div><br/>
            	<?php 
            		$cpt++;
            	}
            	?>
            	<a class="btn btn-default" onclick="ModElmnt(<?php echo $row[0][0]; ?>);">Valider</a>
            </form>
        </div>
    </div>
</section>

