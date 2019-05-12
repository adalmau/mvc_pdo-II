<?php
	/**
	* Aquest arxiu espera 3 tipus de peticions:
	* - Peticions sense cap paràmetre: retornarà la vista principal (MainView.php)
	* - Peticions per GET: accions per mostrar les vistes de formulari de nou ensenyament, editar ensenyament i esborrar ensenyament. També la petició d'esborrar un ensenyament.
	* - Peticions per POST: accions que venen d'un formulari: afegir un nou ensenyament o modificar un ensenyament.
	*
	* En funció de la petició, farà unes crides o unes altres al controlador (EnsenyamentController.php)
	*
	* Gràcies als valors que el model retorna al controlador després de cada acció, i que a la vegada aquest els torna a retornar
	* a qui el cridi, podem tenim sempre a mà l'estat de l'aplicació. Per fer-ho còmode ho desarem a $GLOBALS['app_status'] i així les vistes hi
	* tindran accés en cas que sigui necessari.
	*/

	require("EnsenyamentController.php");

	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'delete')
		{
			if (isset($_GET['id'])) {
				$GLOBALS['app_status'] = deleteEnsenyament($_GET['id']);
			}
			loadMainView();
		}
		else if ($_GET['action'] == 'new')
		{
			loadNewEnsenyamentView();
		}
		else if ($_GET['action'] == 'edit')
		{
			if (isset($_GET['id'])) {
				loadEditEnsenyamentView($_GET['id']);
			}
		}
		else if ($_GET['action'] == 'show')
		{
			if (isset($_GET['id'])) {
				loadShowEnsenyamentView($_GET['id']);
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
			if (isset($_POST['nom'])) {
				$GLOBALS['app_status'] = addEnsenyament($_POST['nom']);
			}
			loadMainView();
		}
		else if ($_POST['action'] == 'up')
		{
			if (isset($_POST['id']) && isset($_POST['nom'])) {
				$GLOBALS['app_status'] = upEnsenyament($_POST['id'], $_POST['nom']);
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
