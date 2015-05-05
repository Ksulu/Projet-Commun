
<h2>Your photos </h2>
<?php
	echo $this->Form->create('Photos', array('action' => 'download'));
	$i = 0;
	if(!empty($results)){	
		foreach ($results as $result):
			echo '<div style="display:inline-block;">';
			echo  '<img src="data:image;base64,'.base64_encode($result['Photo']['data']). '" style="width:350px;height:350px;padding-left:1em;" />';
			
			
			echo $this->Form->input('',array('type' => 'checkbox','name' => $result['Photo']['name'], 'value' => $result['Photo']['idPhoto']));
			$i++;
			echo '</div>';			
		endforeach;
	}
	else{
		echo 'Vous n\'avez ajouté aucune photo !';
	}
	echo $this->Form->end('Submit');

?>
