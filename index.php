<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Llistat de Tastets</title> 
        <link rel="stylesheet" type="text/css" href="css/estils.css">
    </head>
    
    <body> 
        <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="vista/imatges/capcalera_recurs_8.jpg">
            <form method="post" action="zonaprivada.php" id="identificador">
                
                <input type="text" name="perfil" placeholder="perfil">
             
                <input type="password" name="dni" placeholder="password">
                <button type="submit">Accedir a la Zona Privada</button><br>
            </form>
            
            
        </header>
        
    <div id="contenedor">
        <H2>El Campus de la UPC a Vilanova i la Geltrú posa a la vostra disposició diferents laboratoris on el professorat especialitzat impartirà una classe pràctica, una demostració, ... on els alumnes podran participar activament.  Inscriviu-vos als tallers que més us interessin!</H2>
        <div id="video">
       <iframe width="316" height="178" src="https://www.youtube.com/embed/lpuGRjIfI9A?list=PL2vJzlefC7mDqZAEQllt0XNiZ6JLW7TvI" frameborder="0" allowfullscreen></iframe>
        <img src="vista/imatges/fes-tastet.jpg">
        </div>
        <?php
        
        
       $sel = "SELECT * from activitats where activitats.int_borrat='No'";
      
        try{
            $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
            
        $res = $con->query($sel); 
        echo "<table><tr><th colspan=2>Llistat de Tastets</th></tr>";
        foreach($res as $fila)
        {
            echo "<tr><td>".$fila["id"]."</td><td><a href='controlador.php/detallsactivitat?id=".$fila["id"]."'>".$fila["nom"]."</a></td></tr>";
        }
        echo "</table></div>";
        ?>
        
        