<?php echo $this->Form->create('Utilisateurs');?>
    <fieldset>
        <legend><?php echo __('Login form'); ?></legend>
        <?php 
			echo $this->Form->input('login');
			echo $this->Form->input('password');
			/*echo $this->Form->input('role', array(
				'options' => array('admin' => 'Admin', 'auteur' => 'Auteur')
			));*/
		?>
		<?php
			echo $this->Html->link('<span>Add User</span>',array("controller" => "Utilisateurs", "action" => "add"), array('escape' => false));
		?>
    </fieldset>
<?php echo $this->Form->end('Submit');?>
