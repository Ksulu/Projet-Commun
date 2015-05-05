<?php

class UtilisateursController extends AppController {

  

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('User invalide'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {

        if ($this->request->is('post')) {	
			$results = $this->Utilisateur->find('first',array('conditions' => array('Login' => $this->request->data['Utilisateurs']['login'],
			'Password' => $this->request->data['Utilisateurs']['password'])));
			echo debug($results);
			if(empty($results)){
				$this->Utilisateur->create();
				$this->Utilisateur->set(array(
					'Nom' => $this->request->data['Utilisateurs']['nom'],
					'Prenom' => $this->request->data['Utilisateurs']['prenom'],
					'Login' => $this->request->data['Utilisateurs']['login'],
					'Password' => $this->request->data['Utilisateurs']['password'],
					'Email' => $this->request->data['Utilisateurs']['email']
				));
				$newUtilisateur = $this->Utilisateur->save();
				echo 'Nouveau utilisateur : '.$newUtilisateur['Utilisateur']['id'].'<br/>';
				$this->Session->write('Utilisateur.idUtilisateur', $newUtilisateur['Utilisateur']['id']);
				
				 ini_set('SMTP','smtp.free.fr');
				 ini_set('smtp_port',25);
				 ini_set('sendmail_from','te.kevin7@gmail.com');
				 ini_set('display_errors', 'On');
				 $destinataire = $this->request->data['Utilisateurs']['email'];
				 echo debug($destinataire);

				 $headers = array("From: noreply@photographe2mariage.com",
					"Reply-To: dimitri@photographe2mariage.com",
					"X-Mailer: PHP/" . PHP_VERSION
				);
				$headers = implode("\r\n", $headers);
				
				 if(mail($destinataire, "test", "test")){
					mail($destinataire, "Création de votre compte photos", "Création réussie", $headers);
				 }
				 else{
					 echo 'Not OKK';
				 }
			}				
        }
    }
	
	

    public function login() {
        if ($this->request->is('post')) {	
			$results = $this->Utilisateur->find('first',array('conditions' => array('Login' => $this->request->data['Utilisateurs']['login'],
			'Password' => $this->request->data['Utilisateurs']['password'])));
			if(!empty($results)){
				foreach ($results as $result):
					echo 'idUtilisateur :'.$result['idUtilisateur'].'<br/>';
				endforeach;
				$this->Session->write('Utilisateur.idUtilisateur', $results['Utilisateur']['idUtilisateur']);
				$this->Session->write('Utilisateur.Nom', $results['Utilisateur']['Nom']);
				$this->Session->write('Utilisateur.Prenom', $results['Utilisateur']['Prenom']);
				echo debug($this->Session->read('Utilisateur.idUtilisateur'));
				$this->redirect(array('controller' => 'photos', 'action' => 'add'));
			}
			
        }
    }

}

?>