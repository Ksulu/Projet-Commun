<?php echo $this->Form->create('Photos',array('action' => 'add', 'type' => 'file'));?>
	<fieldset>
        <?php 
			echo $this->Form->input('Files.',array('type' => 'file','multiple'));
		?>
    </fieldset>
	<?php
			echo $this->Html->link('<span>Edit photos</span>',array("controller" => "Photos", "action" => "editall"), array('escape' => false));
	?>
<?php 	echo $this->Form->end('Upload'); ?>