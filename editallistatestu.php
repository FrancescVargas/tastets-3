<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Editar llistat d'Estudiants</title>
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
            
        
        if(isset($_GET["id_activitatfeta"]))
        {    
           
            $sel = "SELECT estu_activitats.*,activitats.nom,solicituts.centre,activitats_fetes.data,activitats_fetes.id as idactivitatfeta,activitats_fetes.numestu from activitats,solicituts,activitats_fetes,estu_activitats where solicituts.activitat_id=activitats.id and solicituts.id=activitats_fetes.solicitut_id and estu_activitats.activitats_fetes_id=activitats_fetes.id and activitats_fetes.id=".$_GET['id_activitatfeta'].";";
            $res = $con->query($sel);
            $res=$res->fetchAll();
            
            $sel2 = "SELECT count(*) as numero from estu_activitats where activitats_fetes_id=".$_GET['id_activitatfeta'].";";
            $res2 = $con->query($sel2);
            $res2=$res2->fetch();
         
        
            
        echo "<h2>Edita la taula amb els assistents del centre ".$res[0]["centre"]." al Tastet de ".$res[0]["nom"]." realitzat el dia ".$res[0]["data"]."</h2><h3>Per eliminar registre esborra el DNI</h3>";
        echo "<form id='formmodificar' method='post' action='editallistatestu.php'>";
        for($i=0;$i<$res2["numero"];$i++)       
        {   
            if(isset($i))
            {
                echo "<input class='inputshort' type='number' name='id".$i."' placeholder='id' value='".$res[$i]["id"]."'><input type='text' name='nom".$i."' placeholder='nom' value='".$res[$i]["nom_estu"]."'><input type='text' name='dni".$i."' placeholder='dni' value='".$res[$i]["dni_estu"]."'><input type='text' name='mail".$i."' placeholder='mail' value='".$res[$i]["mail_estu"]."'><input type='hidden' value='".$_GET["id_activitatfeta"]."' name='id_activitatfeta'><input type='hidden' value='".$res[0]["numestu"]."' name='numestu'><input type='hidden' value='".$res[$i]["dni_estu"]."' name='dni_anterior'><br>";
            }
        }
        
         echo "<p><input type='submit' value='acceptar'></p></form>";   
       
        }
            
        if(isset($_POST["nom0"]))
        {
            
            for($i=0;$i<$_POST["numestu"];$i++)
            {
            
                if($_POST["dni$i"]=="")
                {
                    $sql= "delete from estu_activitats where id =".$_POST["id$i"].";";
                    $res=$con->exec($sql);
                    
                }
                
                else
                {    
                    $sql= "UPDATE estu_activitats SET nom_estu = '".$_POST["nom$i"]."', dni_estu = '".$_POST["dni$i"]."', mail_estu = '".$_POST["mail$i"]."' WHERE id =".$_POST["id$i"].";";
                    $res=$con->exec($sql);
                
                }
            }
            
            $sql="select count(*) as numestu from estu_activitats where activitats_fetes_id=".$_POST["id_activitatfeta"].";";
            $res2=$con->query($sql);
            $res2=$res2->fetch();
            $sql2="UPDATE activitats_fetes SET numestu =".$res2["numestu"]." where id=".$_POST["id_activitatfeta"].";";
            $res3=$con->exec($sql2);
            echo $res3;
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