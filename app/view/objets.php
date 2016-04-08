<section>
<?php

/* --- Déclaration des variables --- */
if(isset($_GET['table'])) {
	$t = $params[0];
	$d = $params[1];
	//var_dump($t);
	$nbrData = $params[2][0][0];
	$nbPage = ceil($nbrData/$params[3]);

	/* --- Manipulation --- */
	echo "
	<div class='page-header'>
        <h3>Table ".$_GET['table']."</h3>
    </div>
	<div class='table-responsive'><table border=1 class='table sortable' id='table' name='".$_GET['table']."'><tr><th></th>";
	foreach ($d as $d1) {
	  foreach ($d1 as $tr) {
	    echo "<th> ". $tr . " </th>"; 
	  }
	}
	echo "</tr>";
	foreach ($t as $t1) {
	  //var_dump($value2);
	  echo "<tr>";
	  echo '<td><input type="checkbox" class="checkbox" value="'.$t1[0].'"></td>';
	  foreach ($t1 as $t2) {
	    echo "<td>" . $t2 . "</td>";
	  }
	  echo "</tr>";
	}
	echo "</table></div>";

	for ($i=1; $i <= $nbPage ; $i++) { 
	  echo '<a class="btn btn-default" href="index.php?page=objets&table='.$_GET['table'].'&p='.$i.'" role="button" >'.$i.'</a>';
	}
	
	echo "<p>Action sur la selection :</p>";
	echo '<button onclick="SuprElmnt();">Supprimer</button><br/><br/>';
}
else {
	echo '<div class="page-header"><h3>Liste des tables</h3></div>';
	$appmodel = new AppModel;
	$listTables = $appmodel->getTables();
	
	$html =  '
	<div class="row">
		<div class="col-md-6 ol-md-offset-4">
			<div class="list-group">';
	foreach($listTables as $table) {
 		$html .= '
 			<a class="list-group-item" href="index.php?page=objets&table='.$table[0].'">'.$table[0].'</a>';
	
	}
	$html .= '</div></div></div>';
	
	echo $html;
}
?>
</section>