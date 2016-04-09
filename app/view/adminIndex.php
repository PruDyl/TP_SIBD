<section>
    <div class="page-header">
        <h3>Bienvenue <?php echo $_SESSION['user'] ?></h3>
    </div>
   <div  class="row">
       <div class="col-md-6">
           <h4> Vos droits sont : </h4>
           <table class="table sortable" id="table">
               <thead>
               <th>
                   Droit
               </th>
               <th>
                   Possibilité
               </th>
               </thead>
               <tbody>
               <?php
               $titlePrivillege = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'CREATE', 'DROP', 'RELOAD', 'SHUTDOWN', 'PROCESS', 'FILE', 'GRANT', 'REFERENCES', 'INDEX', 'ALTER', 'SHOW_DB', 'SUPER'];
               foreach($titlePrivillege as $key => $value) {
                   if($params[0][0][$key+3] == 'Y') {
                       echo '<tr class="success">';
                       echo '<td>'.$value.'</td>';
                       echo '<td class="privillegeValue"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                   }
                   else {
                       echo '<tr class="danger">';
                       echo '<td>'.$value.'</td>';
                       echo '<td class="privillegeValue"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>';
                   }
                   echo '</tr>';
               }
               ?>
               </tbody>
           </table>
       </div>
       <div class="col-md-6">
           <h4> Statistiques jeu : </h4>
           <ul class="list-group">
           <?php
                echo '<li class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Nombre actuel de joueurs : '.$params[1][0][0].'</li>
                      <li class="list-group-item"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span> Argent moyen par joueur : '.$params[2][0][0].'</li>
                      <li class="list-group-item"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> joueur le plus riche : '.$params[3][0][1].' pour '.$params[3][0][13].'</li>
                      <li class="list-group-item"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> joueur le moins riche : '.$params[4][0][1].' pour '.$params[4][0][13].'</li>
                ';
           ?>
            </ul>
       </div>
   </div>
</section>
