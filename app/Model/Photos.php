<?php
App::uses('AppModel', 'Model');

class Photos extends AppModel {
    
	public $useTable = 'Photos';
	public $primaryKey = 'idPhoto';
    /*public $validate = array(
        'login' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un nom d\'Photo est requis'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un mot de passe est requis'
            )
        ),
        /*'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'auteur')),
                'message' => 'Merci de rentrer un rôle valide',
                'allowEmpty' => false
            )
        )
    );*/
}
?>