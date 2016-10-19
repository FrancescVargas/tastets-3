<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Emplenar llistat d'Estudiants</title>
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
            
        
        if(isset($_GET["numestu"]) && isset($_GET["id_activitatfeta"]))
        {    
           
            $sel = "SELECT activitats.nom,solicituts.centre,activitats_fetes.data,activitats_fetes.id from activitats,solicituts,activitats_fetes where solicituts.activitat_id=activitats.id and solicituts.id=activitats_fetes.solicitut_id and activitats_fetes.id=".$_GET['id_activitatfeta'].";";
            $res = $con->query($sel);
            $res=$res->fetch();
         

        echo "<h2>Emplena la taula amb els assistents del centre ".$res["centre"]." al Tastet de ".$res["nom"]." realitzat el dia ".$res["data"]."</h2>";
        echo "<form id='formmodificar' method='post' action='llistatestu.php'><p class='instruccio'>El DNI haurà d'estar emplenat per a afegir el registre</p> <br>";
        for($i=0;$i<=$_GET["numestu"];$i++)
        {
            echo "<input type='text' name='nom".$i."' placeholder='nom'><input type='text' name='dni".$i."' placeholder='dni'><input type='text' name='mail".$i."' placeholder='mail'><input type='hidden' value='".$_GET["id_activitatfeta"]."' name='id_activitatfeta'><input type='hidden' value='".$_GET["numestu"]."' name='numestu'><br>";
        }
        
         echo "<p><input type='submit' value='acceptar'></p></form>";   
       
        }
            
        if(isset($_POST["dni0"]))
        {
            
            for($i=0;$i<=$_POST["numestu"];$i++)
            {
            if($_POST["dni$i"]!=="")
                {
                $sql= "INSERT INTO `estu_activitats` (`activitats_fetes_id`, `nom_estu`, `dni_estu`, `mail_estu`) VALUES ('".$_POST["id_activitatfeta"]."', '".$_POST["nom$i"]."', '".$_POST["dni$i"]."', '".$_POST["mail$i"]."');";

                $res=$con->exec($sql);
                }
            }
            $sql="select count(*) as numestu from estu_activitats where activitats_fetes_id=".$_POST["id_activitatfeta"].";";
            $res2=$con->query($sql);
            $res2=$res2->fetch();
            $sql2="UPDATE activitats_fetes SET numestu =".$res2["numestu"]." where id=".$_POST["id_activitatfeta"].";";
            $res3=$con->exec($sql2);
            
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