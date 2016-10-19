<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Afegir tastet fet></title>
        <link rel="stylesheet" type="text/css" href="css/estils.css">
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="/Francesc/Tastets/vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="/Francesc/Tastets/vista/imatges/capcalera_recurs_8.jpg">
            <button><a href="sortirzonaprivada.php">Sortir de la zona Privada</a></button><button><a href="zonaprivada.php">Torna a la teva pàgina d'Inici</a></button><br>
            
            
        </header>
        <div id="contenedor">
          <?php
            session_start();
            require("anyaca.php");
            if(isset($_SESSION["dni"]))
        {
             try
            {
                $con= new PDO('mysql:host=localhost;dbname=activitats', "root");
            }
        catch(PDOException $e)
            {
                echo "Error:".$e->getMessage(); 
                die();
            }
            
        
        if(isset($_GET["id_activitat"]) && isset($_GET["id_solicitut"]))
        {    
           
            
         

        echo "<h2>Ja s'ha fet el tastet? Emplena els detalls</h2>";
        echo "<form id='formmodificar' method='post' action='afegirtastetfet.php'>";
            
        echo "<fieldset><legend>Informació del Tastet:</legend><br>";
        echo "<p class='instruccio'>No utilitzis cometes dobles. Utilitza les simples</p> <br><label>Id Tastet</label> <br><input type='number' name='activitat_id' value=".$_GET["id_activitat"]." class='inputshort'><br>";
        echo "<label>Id Solicitut</label> <br><input type='number' name='solicitut_id' value=".$_GET["id_solicitut"]." class='inputshort'><br>";
        echo "<label>Data</label> <br><input type='date' name='data'><br>";
        echo "<label>Professor</label> <br><input type='text' name='professor'><br>";
        echo "<label>Número d'estudiants</label> <br><input type='number' name='numestu'><br>";
        echo "<label>Comentari</label><br><textarea rows='8' cols='60' name='comentari' ></textarea><br>";
        echo "</fieldset>";      
        echo "<p><input type='submit' value='afegir'></p></form>";

        }
            
        if(isset($_POST["data"]))
        {
            $anyaca=anyaca($_POST["data"]);
               
            $sql = 'INSERT INTO `activitats_fetes` (`activitat_id`, `solicitut_id`, `data`, `professor`, `numestu`, `comentari`,`anyaca`) VALUES ("'.$_POST["activitat_id"].'", "'.$_POST["solicitut_id"].'", "'.$_POST["data"].'", "'.$_POST["professor"].'", "'.$_POST["numestu"].'", "'.$_POST["comentari"].'", "'.$anyaca.'");';
            
            $res=$con->exec($sql);
            
            if($res===false) $_SESSION["error"]="No s'ha pogut crear el tastet-fet fet el ".$_POST["data"]." corresponent a la sol.licitut ".$_POST["solicitut_id"];
            else 
            {
                $_SESSION["error"]="Creat tastet-fet fet el ".$_POST["data"]." corresponent a la sol.licitut  ".$_POST["solicitut_id"];
                $sql2 =  "UPDATE solicituts SET realitzada = 1 WHERE solicituts.id =".$_POST["solicitut_id"].";";
                $res2=$con->exec($sql2);
            }
            header ("Location:zonaprivada.php");
            

        }

         
           
       
        }
        
    
        else
        {
            echo "<h3>Les credencials no son vàlides</h3><div id='tornar'><a href='/Francesc/Tastets/index.php' title='Tornar a Index'><img src='vista/imatges/home.jpg'></a></div>";
            $_SESSION=[];
            session_destroy();
        }
            
        ?>    
            
        
            
            
            
        </div>
    </body>
</html>