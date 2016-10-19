<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Usuari <?php echo $_POST["dni"]; ?></title>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: '#mytextarea'
                , menubar: "edit"
                , plugins: 'textcolor   paste   fullscreen'
                , toolbar: "undo redo cut paste copy  fullscreen |  bold italic forecolor backcolor"
            });
        </script>
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
            
        
        if(isset($_GET["dni"]))
        {    
           
            
         

        echo "<h2>Ara pots afegir un Tastet nou</h2>";
        echo "<form id='formmodificar' method='post' action='afegirtastet.php' enctype='multipart/form-data'>";
            
        echo "<fieldset><legend>Informació Pública:</legend><br>";
        echo "<p class='instruccio'>No utilitzis cometes dobles. Utilitza les simples</p> <br><label>Id</label> <br><input class='inputshort' type='number' name='id'><br>";
        echo "<label>Nom</label> <br><input class='inputlong' type='text' name='nom'><br>";
        echo "<label>Responsable</label> <br><input type='text' name='responsable'><br>";
        echo "<label>DNI</label> <br><input type='text' name='dni' value='".$_GET["dni"]."' ><br>";
        echo "<label>Departament</label> <br><input class='inputlong' type='text' name='departament'><br>";
        echo "<label>Lloc</label> <br><input class='inputlong' type='text' name='lloc'><br>";
        echo "<label>Foto</label><br><input type='file' name='foto'><br>";
        echo "<label>Descripció</label><br><textarea id='mytextarea' rows='8' cols='60' name='descripcio' ></textarea><br>";
        echo "<label>Nombre Màxim d'Alumnes per Sessió</label> <br><input type='number' name='int_maxim_alu' class='inputshort'><br>";
        echo "<label>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller:</label> <br><input type='text' name='int_nivell'><br>";
        echo "<fieldset><legend>Períodes de l&#39;any en que està disponible:</legend> <br>";
         
            
        $sel2 = "SELECT * FROM dispany";
                 $res2 = $con->query($sel2);
                   $res2=$res2->fetchAll();
                 
                 
                
                
            foreach($res2 as $fila)
                 {
                     echo '<input type="checkbox" name="int_dispany" value="'.$fila["id"].'">'.$fila["disp"].'<br>';
                 }
       
          
   
        echo "</fieldset>";
        echo "</fieldset>";
            
            
        echo "<fieldset><legend>Informació Interna:</legend><br>";         
        echo "<label>Comentaris Generals</label> <br><textarea  rows='8' cols='60' name='int_comentari' ></textarea><br>";
        echo "<label>Quantitat màxima de tallers en un any acadèmic:</label> <br><input type='number' class='inputshort' name='int_max_tallers_any'><br>";
        echo "<label>Duració de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_activitat' ><br>";
        echo "<label>Temps de preparació de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_preparacio' ><br>";
        echo "<label>Personal Implicat</label> <br><input type='number' class='inputshort' name='int_personal_implicat'><br>";
        echo "<label>Suggeriments i comentaris:</label><br><textarea rows='8' cols='60' name='int_sugg'></textarea><br>";
        echo "</fieldset>";
            
            
        echo "<p><input type='submit' value='afegir'></p></form>";

        }
            
        if(isset($_POST["nom"]))
        {
            
               if($_FILES['foto']['name']!=="")
                    {
                       
                        $target_path = "vista/imatges/".$_FILES['foto']['name'];
                        $f=$target_path;
                        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $target_path))
                        {

                            echo "";

                        } 
                        $sql = 'INSERT INTO `activitats` (`id`,`nom`, `responsable`, `dni`, `departament`, `lloc`, `descripcio`, `foto`,`int_comentari`, `int_maxim_alu`,`int_nivell`,`int_dispany`,`int_max_tallers_any`,`int_sugg`,`int_duracio_activitat`,`int_duracio_preparacio`,`int_personal_implicat`) VALUES ("'.$_POST["id"].'","'.$_POST["nom"].'", "'.$_POST["responsable"].'", "'.$_POST["dni"].'", "'.$_POST["departament"].'", "'.$_POST["lloc"].'", "'.$_POST["descripcio"].'", "'.$f.'","'.$_POST["int_comentari"].'", "'.$_POST["int_maxim_alu"].'", "'.$_POST["int_nivell"].'", "'.$_POST["int_dispany"].'", "'.$_POST["int_max_tallers_any"].'", "'.$_POST["int_sugg"].'", "'.$_POST["int_duracio_activitat"].'", "'.$_POST["int_duracio_preparacio"].'", "'.$_POST["int_personal_implicat"].'");';
                   
                    }

                   
             
                 else
                 {
                    
                   $sql = 'INSERT INTO `activitats` (`id`,`nom`, `responsable`, `dni`, `departament`, `lloc`, `descripcio`,`int_comentari`, `int_maxim_alu`,`int_nivell`,`int_dispany`,`int_max_tallers_any`,`int_sugg`,`int_duracio_activitat`,`int_duracio_preparacio`,`int_personal_implicat`) VALUES ("'.$_POST["id"].'","'.$_POST["nom"].'", "'.$_POST["responsable"].'", "'.$_POST["dni"].'", "'.$_POST["departament"].'", "'.$_POST["lloc"].'", "'.$_POST["descripcio"].'","'.$_POST["int_comentari"].'", "'.$_POST["int_maxim_alu"].'", "'.$_POST["int_nivell"].'", "'.$_POST["int_dispany"].'", "'.$_POST["int_max_tallers_any"].'", "'.$_POST["int_sugg"].'", "'.$_POST["int_duracio_activitat"].'", "'.$_POST["int_duracio_preparacio"].'", "'.$_POST["int_personal_implicat"].'");';
                     
                 }
                 
                
            $res=$con->exec($sql); 
            if($res===false) 
            {
                if ($con->errorInfo()[2]=="Duplicate entry '".$_POST['id']."' for key 'PRIMARY'") $_SESSION["error"]="No s'ha pogut crear el tastet ".$_POST["nom"]." perquè l'id '".$_POST['id']."' ja existeix";
                else $_SESSION["error"]="No s'ha pogut crear el tastet ".$_POST["nom"].". Revisa que no n'hi hagin camps amb cometes dobles";
            }
            else $_SESSION["error"]="Creat tastet ".$_POST["nom"];
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