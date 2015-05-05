<?php
App::uses('AppModel', 'Model');

class Utilisateurs extends AppModel {
    
	public $useTable = 'Utilisateurs';
	public $primaryKey = 'idUtilisateur';
    /*public $validate = array(
        'login' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un nom d\'utilisateur est requis'
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