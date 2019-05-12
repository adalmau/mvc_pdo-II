<?php
	// Variable global perquè totes les funcions tinguin accés a aquest objecte.
	// S'instancia en modConnect() i per cridar-lo es farà amb $GLOBALS['conn']
	$conn;

	/**
	* Funció bàsica per connectar-nos a la base de dades.
	* Inicialització de l'objecte global $conn.
	* Qualsevol variació dels paràmetres d'accés a la BD es canvia aquí.
	*
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modConnect()
	{
		$servername = "host de la BD";
		$username = "nom d'usuari";
		$password = "contrasenya d'usuari";
		$dbname = "nom de la BD";

		try {
			$GLOBALS['conn'] = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			modInit();

			return ["Connection" => "Success"];
		}
		catch(PDOException $e) {
			return ["Connection failed" => $e->getMessage()];
		}
	}

	/**
	* Funció que retorna l'ensenyament o ensenyaments de la BD
	*
	* @param (Integer) $id - opcional
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modQuery($id = null)
	{
		modConnect();

		try {
			if ($id != null) {
				$stmt = $GLOBALS['conn']->prepare("SELECT * FROM Ensenyaments WHERE id=" . $id);
			}
			else {
				$stmt = $GLOBALS['conn']->prepare("SELECT * FROM Ensenyaments ORDER BY id ASC");
			}
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que afegeix un ensenyament a la BD
	*
	* @param (String) $nom
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modAdd($nom)
	{
		modConnect();

		try {
			$sql = "INSERT INTO Ensenyaments (Nom) VALUES ('" . $nom . "')";
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)) {
				return ["Success" => "Ensenyament afegit correctament"];
			}
			else {
				return ["Error" => "L'ensenyament no s'ha afegit"];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que modifica l'ensenyament a la BD
	*
	* @param (Integer) $id
	* @param (String) $nom
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modUpdate($id, $nom)
	{
		modConnect();

		try {
			$sql = "UPDATE Ensenyaments SET Nom='" . $nom . "' WHERE id='" . $id . "'";
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)) {
				return ["Success" => "Ensenyament modificat correctament"];
			}
			else {
				return ["Error" => "L'ensenyament no s'ha modificat"];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que elimina l'ensenyament de la BD
	*
	* @param (Integer) $id
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modDelete($id)
	{
		modConnect();

		try {
			$sql = "DELETE FROM Ensenyaments WHERE id=".$id;
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)){
				return ["Success" => "Ensenyament eliminat correctament"];
			}
			else {
				return ["Error" => "L'ensenyament no s'ha eliminat"];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que crea les taules a la BD en cas que no estiguin creades.
	* Aquesta funció només l'hauria de cridar modConnect()
	*
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modInit()
	{
		// Si no existeix $conn significarà que no l'està cridant modConnect()
		if (!isset($GLOBALS['conn'])) {
			return ["Error" => "No es pot establir connexió amb la BD."];
		}

		try {
			$sql = "CREATE TABLE IF NOT EXISTS `Ensenyaments` (
	  				`id` int(11) NOT NULL AUTO_INCREMENT,
	  				`Nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	  				PRIMARY KEY (`id`)
				) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
			";

			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)){
				return ["Success" => "Taules inicialitzades."];
			}
			else {
				return ["Error" => "No s'han pogut inicialitzar les taules."];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}
?>
