<?php App::import('Controller', 'Generals'); ?>





<h1>Les utilisateurs du site</h1>

<?php
	$Generals = new GeneralsController;
    	$Generals->constructClasses();
?>

<div id="tabs">





	<div id="tabs-2">
		<?php echo $this->requestAction(array('controller' => 'Utilisateurs','action' => 'login'), array('return')); ?>
	</div>


</div>





