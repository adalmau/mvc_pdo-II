<?php
	require("EnsenyamentModel.php");

	function getEnsenyaments()
	{
		return modQuery();
	}

	function addEnsenyament($nom)
	{
		return modAdd($nom);
	}

	function upEnsenyament($id, $nom)
	{
		return modUpdate($id, $nom);
	}

	function getEnsenyament($id)
	{
		return modQuery($id);
	}

	function deleteEnsenyament($id)
	{
		return modDelete($id);
	}


	/**** FUNCIONS PER CARREGAR LES VISTES ***/

	function loadMainView()
	{
		$result = getEnsenyaments();
		require_once("MainView.php");
	}

	function loadNewEnsenyamentView()
	{
		require_once("NewView.php");
	}

	function loadEditEnsenyamentView($id)
	{
		$result = getEnsenyament($id);
		require_once("EditView.php");
	}

	function loadShowEnsenyamentView($id)
	{
		$result = getEnsenyament($id);
		require_once("ShowView.php");
	}
?>
