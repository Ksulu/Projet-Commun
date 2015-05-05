<?php echo $this->Form->create('Utilisateurs');?>
    <fieldset>
        <legend><?php echo __('Add user form'); ?></legend>
        <?php 
			echo $this->Form->input('nom');
			echo $this->Form->input('prenom');
			echo $this->Form->input('login');
			echo $this->Form->input('password');
			echo $this->Form->input('email');
		?>
    </fieldset>
<?php echo $this->Form->end('Submit');?>
