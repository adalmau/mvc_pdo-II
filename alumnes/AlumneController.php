<?php
	require("AlumneModel.php");

	function getAlumnes()
	{
		return modQuery();
	}

	function getEnsenyaments()
	{
		return modQueryEnsenyaments();
	}

	function addAlumne($nom, $cognom, $data_naixement, $ensenyament_id)
	{
		return modAdd($nom, $cognom, $data_naixement, $ensenyament_id);
	}

	function upAlumne($id, $nom, $cognom, $data_naixement, $ensenyament_id)
	{
		return modUpdate($id, $nom, $cognom, $data_naixement, $ensenyament_id);
	}

	function getAlumne($id)
	{
		return modQuery($id);
	}

	function deleteAlumne($id)
	{
		return modDelete($id);
	}


	/**** FUNCIONS PER CARREGAR LES VISTES ***/

	function loadMainView()
	{
		$result = getAlumnes();
		require_once("MainView.php");
	}

	function loadNewAlumneView()
	{
		$result = getEnsenyaments();
		require_once("NewView.php");
	}

	function loadEditAlumneView($id)
	{
		$result = getAlumne($id);
		$ensenyaments = getEnsenyaments();
		require_once("EditView.php");
	}

	function loadShowAlumneView($id)
	{
		$result = getAlumne($id);
		require_once("ShowView.php");
	}
?>
