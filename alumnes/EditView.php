<!doctype html>
<html lang="ca">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<title>Aproximació a MVC - CRUD PDO</title>
	</head>
	<body>
		<div class="container">
			<div class="py-5 text-center">
				<h1>Aproximació a MVC</h1>
				<h3>CRUD amb PDO</h3>
			</div>
			<div class="alert alert-warning text-center" role="alert">
					Vista d'edició d'alumne
				</div>
			<div class="text-left">
				<form method="POST" action="./index.php">
					<div class="form-group row">
						<label for="id" class="col-sm-2 col-form-label font-weight-bold">Id</label>
						<div class="col-sm-10">
							<input type="text" readonly class="form-control-plaintext" id="id" name="id" value="<?php echo $result[0]['id']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="nom" class="col-sm-2 col-form-label font-weight-bold">Nom</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $result[0]['Nom']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="cognoms" class="col-sm-2 col-form-label font-weight-bold">Cognoms</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="cognoms" name="cognoms" value="<?php echo $result[0]['Cognoms']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="data_naixement" class="col-sm-2 col-form-label font-weight-bold">Data naixement</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="data_naixement" name="data_naixement" value="<?php echo $result[0]['Data_naixement']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="ensenyament_id" class="col-sm-2 col-form-label font-weight-bold">Ensenyament</label>
						<div class="col-sm-10">
							<select class="form-control" name="ensenyament_id" id="ensenyament_id">
								<?php
									foreach ($ensenyaments as $value) {
										$value['id'] == $result[0]['ensenyament_id'] ? $isActive = 'selected' : $isActive = '';
										echo '<option value="' . $value['id'] . '" ' . $isActive . '>' . $value['Nom'] . '</option>';
									}
								?>
							</select>
						</div>
					</div>
					<input type="hidden" name="action" value="up">
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Desar</button>
						<a class="btn btn-secondary" role="button" href="./index.php">Sortir</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
