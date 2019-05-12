<?php
	/**
	* Aquest arxiu espera 3 tipus de peticions:
	* - Peticions sense cap paràmetre: retornarà la vista principal (MainView.php)
	* - Peticions per GET: accions per mostrar les vistes de formulari de nou alumne, editar alumne i esborrar alumne. També la petició d'esborrar un alumne.
	* - Peticions per POST: accions que venen d'un formulari: afegir un nou alumne o modificar un alumne.
	*
	* En funció de la petició, farà unes crides o unes altres al controlador (AlumneController.php)
	*
	* Gràcies als valors que el model retorna al controlador després de cada acció, i que a la vegada aquest els torna a retornar
	* a qui el cridi, podem tenim sempre a mà l'estat de l'aplicació. Per fer-ho còmode ho desarem a $GLOBALS['app_status'] i així les vistes hi
	* tindran accés en cas que sigui necessari.
	*/

	require("AlumneController.php");

	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'delete')
		{
			if (isset($_GET['id'])) {
				$GLOBALS['app_status'] = deleteAlumne($_GET['id']);
			}
			loadMainView();
		}
		else if ($_GET['action'] == 'new')
		{
			loadNewAlumneView();
		}
		else if ($_GET['action'] == 'edit')
		{
			if (isset($_GET['id'])) {
				loadEditAlumneView($_GET['id']);
			}
		}
		else if ($_GET['action'] == 'show')
		{
			if (isset($_GET['id'])) {
				loadShowAlumneView($_GET['id']);
			}
		}
		else
		{
			loadMainView();
		}
	}
	else if (isset($_POST['action']))
	{
		if ($_POST['action'] == 'add')
		{
			if (isset($_POST['nom']) && isset($_POST['cognoms']) && isset($_POST['data_naixement']) && isset($_POST['ensenyament_id'])) {
				$GLOBALS['app_status'] = addAlumne($_POST['nom'], $_POST['cognoms'], $_POST['data_naixement'], $_POST['ensenyament_id']);
			}
			loadMainView();
		}
		else if ($_POST['action'] == 'up')
		{
			if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['cognoms']) && isset($_POST['data_naixement']) && isset($_POST['ensenyament_id'])) {
				$GLOBALS['app_status'] = upAlumne($_POST['id'], $_POST['nom'], $_POST['cognoms'], $_POST['data_naixement'], $_POST['ensenyament_id']);
			}
			loadMainView();
		}
		else
		{
			loadMainView();
		}
	}
	else
	{
		loadMainView();
	}
?>
