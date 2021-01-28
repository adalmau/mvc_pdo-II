# mvc_pdo II
Aproximació a l'arquitectura **MVC amb PDO**.

Repositori pensat per alumnes del **Mòdul 7: Desenvolupament en entorn servidor** del CFGS de DAW, concretament per la **UF3: Tècniques d'accés a dades**.

Aquest repositori és una evolució del repositori [mvc_pdo I](https://github.com/adalmau/mvc_pdo-I). Ara se'ns planteja la possibilitat que un alumne pertanyi a un ensenyament. Per aconseguir-ho crearem un altre CRUD per a *Ensenyaments* seguint la mateixa estructura del CRUD *Alumnes*.

![MVC](https://github.com/adalmau/mvc_pdo-II/blob/master/esquema.png)

Com s'aprecia a la imatge, el que s'ha fet ha estat copiar tota l'estructura d'un CRUD per fer l'altre. No tenen més relació que un enllaç en la vista principal, i que, evidentment, utilitzen la mateixa BD.

Per aconseguir que quan insertem un alumne apareguin tots els enseyaments per ser escollits (el nom, no només la id de l'ensenyament), s'ha fet una LEFT JOIN:

```
SELECT Alumnes.*, Ensenyaments.Nom AS ensenyament_nom FROM Alumnes LEFT JOIN Ensenyaments ON Alumnes.ensenyament_id = Ensenyaments.id  ORDER BY Alumnes.id ASC 
```

Respecte al repositori **mvc_pdo I** s'ha aprofitat l'estructura de respostes desades en un array per mostrar-les per consola a les vistes.

També s'ha creat el mètode *modInit()*, en els dos models (**AlumneModel.php** i **EnsenyamentModel.php**), que es crida sempre que es fa una connexió a la BD. Aquest mètode comprova si hi ha creada la taula Alumnes o Ensenyaments, i si no és així, les crea. Com que aquests mètodes treballen de forma aïllada, cal primer entrar al CRUD d'enseyaments perquè es creï la seva taula i posteriorment cal entrar al CRUD d'alumnes on es crearà la taula Alumnes i la constraint de clau forana cap a Ensenyaments.

Continuem sense tenir cap arxiu de configuració. Els únics paràmetres que cal canviar per fer-lo funcionar es troben en el model (**AlumneModel.php** i **EnsenyamentModel.php**), on dins la funció *modConnect()* trobem:

```
$servername = "host de la BD";
$username = "nom d'usuari";
$password = "contrasenya d'usuari";
$dbname = "nom de la BD";
```
