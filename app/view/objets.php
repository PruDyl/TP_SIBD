<?php

/* --- Déclaration des variables --- */
$t = $params[0];
//var_dump($params[1]);
$d = $params[1];
$nbrData = $params[2][0][0];
$nbPage = ceil($nbrData/$params[3]);
$table = $params[5];

/* --- Manipulation --- */
echo "<div class='table-responsive'><table border=1 class='table'><tr>";
foreach ($d as $d1) {
  foreach ($d1 as $tr) {
    echo "<td> ". $tr . " </td>"; 
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
  echo "<a class='btn btn-default' href = 'index.php?page=objets&table=$table&p=$i' role='button' >$i</a> ";
}