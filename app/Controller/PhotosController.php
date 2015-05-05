<?php

class PhotosController extends AppController {

  

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
	}
	
	

	
	public function add(){
				
		if ($this->request->is('post')) {
			if (!empty($this->data['Photos'])) {	
				$max = count($this->data['Photos']['Files']) +1 ;
				foreach ($this->data['Photos'] as $photo):
					for($i=0 ; $i < $max; $i++){
						if(!empty($photo[$i]['name'])){
							$fileData = fread(fopen($photo[$i]['tmp_name'], "r+"), $photo[$i]['size']);						
							$data['Photos'][$i]['data'] = $fileData;	
							$data['Photos'][$i]['name'] = $photo[$i]['name'];
							$data['Photos'][$i]['type'] = $photo[$i]['type'];
							$data['Photos'][$i]['size'] = $photo[$i]['size'];
							$data['Photos'][$i]['idUtilisateur'] = $this->Session->read('Utilisateur.idUtilisateur');	
							$this->Photo->create();
							$this->Photo->save($data['Photos'][$i]);
						}						
					}	
				endforeach;			
			}
		}   
	}

    public function editAll() {
		echo 'Utilisateur courant : '.$this->Session->read('Utilisateur.Nom').'</br>';
		$results = $this->Photo->find('all',array('conditions' => array('idUtilisateur' => $this->Session->read('Utilisateur.idUtilisateur'))));
		if(!empty($results)){				
			$this->set('results', $results);
		}	
		$i = 0;
		$test = null;
		foreach ($results as $result):			
			$tab = array(array('name' => $result['Photo']['name']), 'Token' => $i);
			$resultats[$i] = Set::merge($tab,$test);
			$i++;			
		endforeach;
    }
	
	public function download(){
		echo 'Download !!</br>';
		$checked = (array_chunk($this->request->data,1));
		for($i = 0;$i < count($checked); $i++){
			$results = $this->Photo->find('first',array('conditions' => array('idUtilisateur' => $this->Session->read('Utilisateur.idUtilisateur'),'idPhoto' => $checked[$i][0])));	
			if(!empty($results)){
				$source = imagecreatefromstring($results['Photo']['data']);
				$directory = 'temp/';
				if(is_dir($directory)){
					imagejpeg($source,$directory.$results['Photo']['name'],100);
				}	
				
			}
		}
		$this->createZip($directory);
	}	
	
	
	public function createZip($source){

		$nom = $this->Session->read('Utilisateur.Nom')."".$this->Session->read('Utilisateur.Prenom');
		echo $nom;
		
		$zipname = "Photos_".$nom.".zip";
		$zip = new ZipArchive;
		$zip->open($zipname, ZIPARCHIVE::CREATE);

		$source = str_replace('\\', '/', realpath($source));
		
		if (is_dir($source) === true){
			$files = new RecursiveDirectoryIterator($source, RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file){
				$file = str_replace('\\', '/', $file);
				if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
					continue;
				if (is_file($file) === true){
					$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		}
		else if (is_file($source) === true){
			$zip->addFromString(basename($source), file_get_contents($source));
		}		
		$zip->close();
	
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename='.$zipname);
		header('Content-Leng: ' . filesize($zipname));
		readfile($zipname);
		
		if(file_exists($zipname)){
			unlink($zipname);
		}

		$dirHandle = opendir($source);
		while ($file = readdir($dirHandle)) {
			if(!is_dir($file)) {
				unlink ($source."/".$file);
			}
		}
		closedir($dirHandle);

	}
	
	
	/*function Zip($source, $destination){

		if (!extension_loaded('zip') || !file_exists($source)) {
			return false;
		}

		$zip = new ZipArchive();
		if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
			return false;
		}

		$source = str_replace('\\', '/', realpath($source));
		
		if (is_dir($source) === true){
			$files = new RecursiveDirectoryIterator($source, RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file){
				$file = str_replace('\\', '/', $file);
				if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
					continue;
				if (is_file($file) === true){
					$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		}
		else if (is_file($source) === true){
			$zip->addFromString(basename($source), file_get_contents($source));
		}		
		return $zip->close();
	}*/
	
}

?>