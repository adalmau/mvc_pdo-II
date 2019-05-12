<!doctype html>
<html lang="ca">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<title>Aproximació a MVC - CRUD PDO</title>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light mt-5 mb-5">
				<span class="navbar-brand">Aproximació a MVC | CRUD amb PDO</span>
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			    	<span class="navbar-toggler-icon"></span>
			  	</button>
			  	<div class="collapse navbar-collapse" id="navbarNavDropdown">
			    	<ul class="navbar-nav">
			      		<li class="nav-item dropdown">
				        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          		CRUDs disponibles
				        	</a>
				        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				          		<a class="dropdown-item" href="#">Alumnes</a>
				          		<a class="dropdown-item" href="../ensenyaments">Ensenyaments</a>
				        	</div>
			      		</li>
			    	</ul>
			  	</div>
			</nav>
			<div class="table-responsive-sm">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th class="align-middle">ID</th>
							<th class="align-middle">NOM</th>
							<th class="align-middle">COGNOMS</th>
							<th class="align-middle">DATA NAIXEMENT</th>
							<th class="align-middle">ENSENYAMENT</th>
							<th class="align-middle text-right"><a class="btn btn-primary" role="button" href="?action=new">Afegir</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($result as $row) {
								echo "<tr>";
								echo "<td class='align-middle'>" . $row['id'] . "</td>";
								echo "<td class='align-middle'>" . $row['Nom'] . "</td>";
								echo "<td class='align-middle'>" . $row['Cognoms'] . "</td>";
								echo "<td class='align-middle'>" . date('d/m/Y', strtotime($row['Data_naixement'])) . "</td>";
								echo "<td class='align-middle'>" . $row['ensenyament_nom'] . "</td>";
								echo "<td class='align-middle'>";
								echo "<a class='btn btn-success' role='button' href='?action=show&id=".$row['id']."'>Mostrar</a> ";
								echo "<a class='btn btn-warning' role='button' href='?action=edit&id=".$row['id']."'>Editar</a> ";
								echo "<a class='btn btn-danger' role='button' href='?action=delete&id=".$row['id']."'>Eliminar</a> ";
								echo "</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript">
			window.onload = function() {
				var app_status = <?php echo json_encode($GLOBALS['app_status']); ?>;
				console.log(app_status);
			}
		</script>
	</body>
</html>
