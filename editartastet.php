<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Editar Activitat</title>
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
            <button><a href="sortirzonaprivada.php">Sortir de la zona Privada</a></button>
            <button><a href="zonaprivada.php">Torna a la teva pàgina d'Inici</a></button>
            <br>
            
            
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
            
             if(isset($_GET['id']))
             {
                 $sel = "SELECT * FROM activitats WHERE activitats.id =".$_GET['id']."";
                 $res = $con->query($sel);
                   $res=$res->fetch();
                   

                 echo "<h2>Ara pots editar les dades del tastet ".$res["nom"]."</h2>";

                  echo "<form id='formmodificar' method='post' action='editartastet.php' enctype='multipart/form-data'>";
                 echo "<fieldset><legend>Informació Pública:</legend><br>";
                 echo "<p class='instruccio'>No utilitzis cometes dobles. Utilitza les simples</p> <br><input type='hidden' name='id_anterior' value='".$res["id"]."'>";
                echo "<label>Id</label><input type='number' name='id' value='${res['id']}'><br>";
                echo '<label>Nom</label> <br><input type="text" class="inputlong" name="nom" value="'.$res['nom'].'"><br>';
                echo '<label>Responsable</label> <br><input type="text" name="responsable" value="'.$res['responsable'].'"><br>';
                 
                echo '<label>DNI</label> <br><input type="text" name="dni" value="'.$res['dni'].'"><br>';
                echo '<label>Departament</label> <br><input class="inputlong" type="text" name="departament" value="'.$res['departament'].'"><br>';
                echo '<label>Lloc</label> <br><input class="inputlong" type="text" name="lloc" value="'.$res['lloc'].'"><br>';
                echo "<label>Foto</label><br><img alt='foto'  class='fototastet' src='${res['foto']}'><input type='file' name='foto' ><br>";
                echo '<label>Descripció</label><br><textarea id="mytextarea" rows="8" cols="60" name="descripcio" >'.$res['descripcio'].'</textarea><br>';
                echo "<label>Nombre Màxim d'Alumnes per Sessió</label> <br><input type='number' name='int_maxim_alu' class='inputshort' value='${res['int_maxim_alu']}'><br>";
                echo "<label>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller:</label> <br><input type='text' name='int_nivell' value='${res['int_nivell']}'><br>";
                echo "<fieldset><legend>Períodes de l&#39;any en que està disponible:</legend> <br>";
               
                 
                 $sel2 = "SELECT * FROM dispany";
                 $res2 = $con->query($sel2);
                   $res2=$res2->fetchAll();
                 
                
                 
                 foreach($res2 as $fila)
                 {
                     if($fila["id"]==$res["int_dispany"]) echo '<input type="checkbox" name="int_dispany" value="'.$fila["id"].'" checked>'.$fila["disp"].'<br>';
                     else echo '<input type="checkbox" name="int_dispany" value="'.$fila["id"].'">'.$fila["disp"].'<br>';
                 }
       
                
                echo "</fieldset>";
                echo "</fieldset>";
                 
                 
                 echo "<fieldset><legend>Informació Interna:</legend><br>";
                
                echo "<label>Comentaris Generals</label> <br><textarea  rows='8' cols='60' name='int_comentari' > ${res['int_comentari']}</textarea><br>";
                echo "<label>Quantitat màxima de tallers en un any acadèmic:</label> <br><input type='number' class='inputshort' name='int_max_tallers_any' value='${res['int_max_tallers_any']}'><br>";
                echo "<label>Duració de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_activitat' value='${res['int_duracio_activitat']}'><br>";
                echo "<label>Temps de preparació de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_preparacio' value='${res['int_duracio_preparacio']}'><br>";
                echo "<label>Personal Implicat</label> <br><input type='number' class='inputshort' name='int_personal_implicat' value='${res['int_personal_implicat']}'><br>";
                echo "<label>Suggeriments i comentaris:</label><br><textarea rows='8' cols='60' name='int_sugg' > ${res['int_sugg']}</textarea><br>";
                echo "</fieldset>";

                echo "<p><input type='submit' value='modificar'></p></form>";
      
             }
            
            
             if(isset($_POST['id']))
             {
   
                if($_FILES['foto']['name']!=="")
                    {

                        $target_path = "vista/imatges/".$_FILES['foto']['name'];
                        $f=$target_path;
                        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $target_path))
                        {
                            echo "";
                        } 
                        
                        $sql= 'UPDATE activitats SET id = '.$_POST["id"].', nom = "'.$_POST["nom"].'", responsable = "'.$_POST["responsable"].'", dni = "'.$_POST["dni"].'", departament = "'.$_POST["departament"].'", lloc = "'.$_POST["lloc"].'", descripcio = "'.$_POST["descripcio"].'", foto = "'.$f.'", int_comentari= "'.$_POST["int_comentari"].'", int_maxim_alu= "'.$_POST["int_maxim_alu"].'", int_nivell= "'.$_POST["int_nivell"].'", int_dispany= "'.$_POST["int_dispany"].'", int_max_tallers_any= "'.$_POST["int_max_tallers_any"].'", int_sugg= "'.$_POST["int_sugg"].'", int_duracio_activitat="'.$_POST["int_duracio_activitat"].'", int_duracio_preparacio="'.$_POST["int_duracio_preparacio"].'", int_personal_implicat="'.$_POST["int_personal_implicat"].'" WHERE activitats.id ='.$_POST["id_anterior"].';';
                    }

                   
             
                 else
                 {
                   $sql= 'UPDATE activitats SET id = '.$_POST["id"].', nom = "'.$_POST["nom"].'", responsable = "'.$_POST["responsable"].'", dni = "'.$_POST["dni"].'", departament = "'.$_POST["departament"].'", lloc = "'.$_POST["lloc"].'", descripcio = "'.$_POST["descripcio"].'", int_comentari= "'.$_POST["int_comentari"].'", int_maxim_alu= "'.$_POST["int_maxim_alu"].'", int_nivell= "'.$_POST["int_nivell"].'", int_dispany= "'.$_POST["int_dispany"].'", int_max_tallers_any= "'.$_POST["int_max_tallers_any"].'", int_sugg= "'.$_POST["int_sugg"].'", int_duracio_activitat="'.$_POST["int_duracio_activitat"].'", int_duracio_preparacio="'.$_POST["int_duracio_preparacio"].'", int_personal_implicat="'.$_POST["int_personal_implicat"].'"  WHERE activitats.id ='.$_POST["id_anterior"].';';
                 }
                
                 $res=$con->exec($sql); 
                 if($res===false) $_SESSION["error"]="No s'ha pogut editar el tastet ".$_POST["nom"];
                 else $_SESSION["error"]="Editat tastet ".$_POST["nom"];
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