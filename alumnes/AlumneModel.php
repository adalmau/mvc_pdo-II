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
	* Funció que retorna l'usuari o usuaris de la BD
	*
	* @param (Integer) $id - opcional
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modQuery($id = null)
	{
		modConnect();

		try {
			if ($id != null) {
				$stmt = $GLOBALS['conn']->prepare("SELECT Alumnes.*, Ensenyaments.Nom AS ensenyament_nom FROM Alumnes LEFT JOIN Ensenyaments ON Alumnes.ensenyament_id = Ensenyaments.id WHERE Alumnes.id=" . $id);
			}
			else {
				$stmt = $GLOBALS['conn']->prepare("SELECT Alumnes.*, Ensenyaments.Nom AS ensenyament_nom FROM Alumnes LEFT JOIN Ensenyaments ON Alumnes.ensenyament_id = Ensenyaments.id  ORDER BY Alumnes.id ASC");
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
	* Funció que retorna els ensenyaments disponibles on matricular un alumne
	*
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modQueryEnsenyaments()
	{
		modConnect();

		try {
			$stmt = $GLOBALS['conn']->prepare("SELECT * FROM Ensenyaments ORDER BY Nom ASC");
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que afegeix un usuari a la BD
	*
	* @param (String) $nom
	* @param (String) $cognom
	* @param (Date) $data_naixement
	* @param (Integer) $ensenyament_id
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modAdd($nom, $cognoms, $data_naixement, $ensenyament_id)
	{
		modConnect();

		try {
			$sql = "INSERT INTO Alumnes (Nom, Cognoms, Data_naixement, ensenyament_id) VALUES ('" . $nom . "', '" . $cognoms . "', '" . $data_naixement . "', '" . $ensenyament_id . "')";
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)) {
				return ["Success" => "Usuari afegit correctament"];
			}
			else {
				return ["Error" => "L'usuari no s'ha afegit"];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que modifica l'usuari a la BD
	*
	* @param (Integer) $id
	* @param (String) $nom
	* @param (String) $cognom
	* @param (Date) $data_naixement
	* @param (Integer) $ensenyament_id
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modUpdate($id, $nom, $cognoms, $data_naixement, $ensenyament_id)
	{
		modConnect();

		try {
			$sql = "UPDATE Alumnes SET Nom='" . $nom . "', Cognoms='" . $cognoms . "', Data_naixement='" . $data_naixement . "', ensenyament_id='" . $ensenyament_id . "' WHERE id='" . $id . "'";
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)) {
				return ["Success" => "Usuari modificat correctament"];
			}
			else {
				return ["Error" => "L'usuari no s'ha modificat"];
			}
		}
		catch(PDOException $e) {
			return ["Error" => $e->getMessage()];
		}
	}

	/**
	* Funció que elimina l'usuari a la BD
	*
	* @param (Integer) $id
	* @return (Array) associatiu amb resultats o bé un missatge d'error.
	*/
	function modDelete($id)
	{
		modConnect();

		try {
			$sql = "DELETE FROM Alumnes WHERE id=".$id;
			// use exec() because no results are returned
			if ($GLOBALS['conn']->exec($sql)){
				return ["Success" => "Usuari eliminat correctament"];
			}
			else {
				return ["Error" => "L'usuari no s'ha eliminat"];
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
			$sql = "CREATE TABLE IF NOT EXISTS `Alumnes` (
	  				`id` int(11) NOT NULL AUTO_INCREMENT,
	  				`Nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	  				`Cognoms` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
	  				`Data_naixement` date NOT NULL,
					`ensenyament_id` int(11) DEFAULT NULL,
	  				PRIMARY KEY (`id`),
					FOREIGN KEY (`ensenyament_id`) REFERENCES `Ensenyaments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
