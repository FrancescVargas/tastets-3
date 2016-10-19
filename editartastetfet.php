<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Editar Tastet Fet</title>
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
           
            $sel = "SELECT activitats.nom,activitats_fetes.* FROM activitats_fetes,activitats WHERE activitats_fetes.activitat_id=activitats.id and activitats_fetes.solicitut_id =".$_GET['id_solicitut'].";";
            $res = $con->query($sel);
            $res=$res->fetch();
            
            $sel2 = "SELECT count(*) as estu FROM estu_activitats WHERE activitats_fetes_id =".$res['id'].";";
            $res2 = $con->query($sel2);
            
            if($res2)$res2=$res2->fetch();
            if(!$res2)$res2["estu"]=0;
           
        echo "<h2>Modifica els detalls del Tastet fet el ".$res["data"]."</h2>";
        echo "<form id='formmodificar' method='post' action='editartastetfet.php'>";
            
        echo "<fieldset><legend>Informació del Tastet:</legend><br>";
        echo "<p class='instruccio'>No utilitzis cometes dobles. Utilitza les simples</p> <br><input type='hidden' name='nom' value=".$res["nom"]."><input type='hidden' name='id' value=".$res["id"].">";
        echo "<label>Id Tastet</label> <br><input type='number' name='activitat_id' value=".$_GET["id_activitat"]." class='inputshort'><br>";
        echo "<label>Id Solicitut</label> <br><input type='number' name='solicitut_id' value=".$_GET["id_solicitut"]." class='inputshort'><br>";
        echo "<label>Data</label> <br><input type='date' name='data' value=".$res["data"]."><br>";
        echo '<label>Professor</label> <br><input type="text" name="professor" value="'.$res["professor"].'"><br>';
        echo "<label>Número d'estudiants</label> <br><input type='number' name='numestu' value=".$res["numestu"]."><br>";
        echo '<label>Comentari</label><br><textarea rows="8" cols="60" name="comentari">'.$res["comentari"].'</textarea><br>';
        echo "</fieldset>";  
        echo "<fieldset><legend>Llistat d'Estudiants</legend><button><a href='llistatestu.php?numestu=".$res["numestu"]."&id_activitatfeta=".$res["id"]."'>Afegir estudiants</a></button><span> Hi han ".$res2["estu"]." registres introduïts </span>";
        if($res2["estu"]>0) echo "<button><a href='editallistatestu.php?id_activitatfeta=".$res["id"]."'>Editar/Eliminar Registres d'Estudiants</a></button>";
        echo "</fieldset>";
        
        echo "<p><input type='submit' value='afegir'></p></form>";
            
       
        }
            
        if(isset($_POST["data"]))
        {
            
             
            $anyaca=anyaca($_POST["data"]);
            $sql= 'UPDATE activitats_fetes SET data = "'.$_POST["data"].'", professor = "'.$_POST["professor"].'", numestu = "'.$_POST["numestu"].'", comentari = "'.$_POST["comentari"].'", anyaca='.$anyaca.' WHERE activitats_fetes.id ='.$_POST["id"].';';
            
            $res=$con->exec($sql);
            if($res===false) $_SESSION["error"]="No s'ha pogut editar la classe de ".$_POST["nom"]." del dia ".$_POST["data"];
            else $_SESSION["error"]="Editada la clase de ".$_POST["nom"]."  del dia ".$_POST["data"];
            
            
            
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