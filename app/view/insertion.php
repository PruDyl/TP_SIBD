<section>
    <div class="page-header">
        <h3>Insérer des données</h3>
        <?php
        if (isset($_GET['table'])) {
            echo '<a class="btn btn-link" href="index.php?page=objets">Retour</a>';
        }
        ?>
    </div>
    <?php
    	$form = '<div class="row"><form method="post" class="col-md-4 col-md-offset-4" action="index.php?page=insertion&table='.$_GET['table'].'">';
		foreach($params[0] as $value) {
			if($value[0] != 'id_'.$_GET['table']) {
				$form.='<div class="input-group input-group-sm"><span class="input-group-addon">'.$value[0].'</span><input class="form-control" type="text" name="'.$value[0].'" /></div><br />';
			}
		}
		
		$form .=' <input class="btn btn-default" type="submit" name="submit" value="Ajouter"/><br/></form></div>';
		echo $form;
    ?>
</section>