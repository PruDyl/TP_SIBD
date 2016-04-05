<?php

/* --- Déclaration des variables --- */
if(isset($_GET['table'])) {
	$t = $params[0];
	$d = $params[1];
	//var_dump($d);
	$nbrData = $params[2][0][0];
	$nbPage = ceil($nbrData/$params[3]);

	/* --- Manipulation --- */
	echo "<div class='table-responsive'><table border=1 class='table sortable' id='table'><tr>";
	foreach ($d as $d1) {
	  foreach ($d1 as $tr) {
	    echo "<th> ". $tr . " </th>"; 
	  }
	}
	echo "</tr>";
	foreach ($t as $t1) {
	  //var_dump($value2);
	  echo "<tr>";
	  foreach ($t1 as $t2) {
	    echo "<td>" . $t2 . "</td>";
	  }
	  echo "</tr>";
	}
	echo "</table></div>";

	for ($i=1; $i <= $nbPage ; $i++) { 
	  echo '<a class="btn btn-default" href="index.php?page=objets&table='.$_GET['table'].'&p='.$i.'" role="button" >'.$i.'</a> ';
	}
}
else {
	echo '<p>Liste des tables : </p>';
	$appmodel = new AppModel;
	$listTables = $appmodel->getTables();
	
	$html =  '<ul>';
	foreach($listTables as $table) {
 		$html .= '<li><a href="index.php?page=objets&table='.$table[0].'">'.$table[0].'</a></li>';
	}
	$html .= '</ul>';
	
	echo $html;
}
