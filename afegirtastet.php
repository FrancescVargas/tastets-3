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
                , plugins: 'paste   fullscreen'
                , toolbar: "undo redo cut paste copy  fullscreen |  bold italic"
            });
        </script>
 <link rel="stylesheet" type="text/css" href="css/estils.css">
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="vista/imatges/capcalera_recurs_8.jpg">
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
           
            
  //  --------------------------  FORMULARI  -----------------------------       

        echo "<h2>Ara pots afegir un Tastet nou</h2>";
        echo "<form id='formmodificar' method='post' action='afegirtastet.php' enctype='multipart/form-data'>";
            
        echo "<fieldset><legend>Informació Pública:</legend><br>";
        echo "<p class='instruccio'>No utilitzis cometes dobles. Utilitza les simples</p> <br><label>Id</label> <br><input class='inputshort' type='number' name='id' required><br>";
        echo "<label>Nom</label> <br><input class='inputlong' type='text' name='nom' required><br>";
        echo "<label>Responsable</label> <br>";
            
            
                //  --------------------------  ESCOLLIM RESPONSABLE D'ENTRE ELS PROFESSORS  -----------------------------
            
            
        $sel3 = "SELECT 340_personal.* FROM 340_personal,340_personal_epsevg where 340_personal.dni=340_personal_epsevg.dni and 340_personal_epsevg.incid='A' order by nom;";
        $res3 = $con->query($sel3);
        $res3=$res3->fetchAll();
        
        echo "<select name='responsable'>";
        echo "<option value='' selected>Buit</option>";
        foreach($res3 as $fila)
         {
             echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."'>".$fila["nom"]." ".$fila["cognoms"]."</option>;";
            
         }


        echo "</select><br>";     
            
            
        
        echo "<label>Lloc</label> <br><input class='inputlong' type='text' name='lloc'><br>";
        echo "<label>Foto</label><br><input type='file' name='foto'><br>";
        echo "<label>Descripció</label><br><textarea id='mytextarea' rows='8' cols='60' name='descripcio' ></textarea><br>";
        echo "<label>Nombre Màxim d'Alumnes per Sessió</label> <br><input type='number' name='int_maxim_alu' class='inputshort'><br>";
        echo "<label>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller:</label> <br><input type='text' name='int_nivell'><br>";
        echo "<fieldset><legend>Períodes de l&#39;any en que està disponible:</legend> <br>";
          
   
        
            
        echo  '<input type="checkbox" name="dispany1" value="Intersemestral (Gener-Febrer)">Intersemestral (Gener-Febrer)<br>';
        echo  '<input type="checkbox" name="dispany2" value="Setmanes d’exàmens parcials">Setmanes d’exàmens parcials<br>';
        echo  '<input type="checkbox" name="dispany3" value="Els dies de JPO">Els dies de JPO<br>';
        echo  '<input type="checkbox" name="dispany4" value="Durant tot l&#39;any" checked>Durant tot l&#39;any<br>';
        echo  '<input type="checkbox" name="dispany5" value="Altres" >Altres<br>';
        echo "</fieldset>";
        echo "</fieldset>";
            
            
        echo "<fieldset><legend>Informació Interna:</legend><br>";         
        echo "<label>Comentaris Generals</label> <br><textarea  rows='8' cols='60' name='int_comentari' ></textarea><br>";
        echo "<label>Quantitat màxima de tallers en un any acadèmic:</label> <br><input type='number' class='inputshort' name='int_max_tallers_any'><br>";
        echo "<label>Duració de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_activitat' ><br>";
        echo "<label>Temps de preparació de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_preparacio' ><br>";
        echo "<label>Personal Implicat</label> <br>";
          
            
                //  --------------------------  ESCOLLIM PARTICIPANTS D'ENTRE ELS PROFESSORS  -----------------------------
            
            
        for($i=0;$i<4;$i++)
        {
            echo "<select name='personal_implicat".$i."'>";
            echo "<option value='' selected>Buit</option>";
            foreach($res3 as $fila)
             {
                 echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."'>".$fila["nom"]." ".$fila["cognoms"]."</option>";
             }
            echo "</select><br>";  
        }
        
        echo "<label>Suggeriments i comentaris:</label><br><textarea rows='8' cols='60' name='int_sugg'></textarea><br>";
        echo "</fieldset>";   
        echo "<p><input type='submit' value='afegir'></p></form>";
            
            
    //  --------------------------  FI DEL FORMULARI  -----------------------------

        }
            
        if(isset($_POST["nom"]))
        {
                $_POST['descripcio'] = str_replace("\"", "'", $_POST['descripcio']);
                $dispany="";
                for($i=1;$i<=5;$i++)
                {
                    if(isset($_POST["dispany".$i]))
                    {
                        $dispany=$dispany."-".$_POST["dispany".$i];
        
                    }
                }
            
               if($_FILES['foto']['name']!=="")
                    {
                       
                        $target_path = "vista/imatges/".$_FILES['foto']['name'];
                        $f=$target_path;
                        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $target_path))
                        {

                            echo "";

                        } 
                        $sql = 'INSERT INTO `activitats` (`id`,`nom`, `responsable`,`lloc`, `descripcio`, `foto`,`int_comentari`, `int_maxim_alu`,`int_nivell`,`int_max_tallers_any`,`int_sugg`,`int_duracio_activitat`,`int_duracio_preparacio`,`prova_intdispany`) VALUES ("'.$_POST["id"].'","'.$_POST["nom"].'", "'.$_POST["responsable"].'",  "'.$_POST["lloc"].'", "'.$_POST["descripcio"].'", "'.$f.'","'.$_POST["int_comentari"].'", "'.$_POST["int_maxim_alu"].'", "'.$_POST["int_nivell"].'",  "'.$_POST["int_max_tallers_any"].'", "'.$_POST["int_sugg"].'", "'.$_POST["int_duracio_activitat"].'", "'.$_POST["int_duracio_preparacio"].'","'.$dispany.'");';
                   
                    }

                else
                 {
                    
                        $sql = 'INSERT INTO `activitats` (`id`,`nom`, `responsable`,`lloc`, `descripcio`,`int_comentari`, `int_maxim_alu`,`int_nivell`,`int_max_tallers_any`,`int_sugg`,`int_duracio_activitat`,`int_duracio_preparacio`,`prova_intdispany`) VALUES ("'.$_POST["id"].'","'.$_POST["nom"].'", "'.$_POST["responsable"].'","'.$_POST["lloc"].'", "'.$_POST["descripcio"].'","'.$_POST["int_comentari"].'", "'.$_POST["int_maxim_alu"].'", "'.$_POST["int_nivell"].'",  "'.$_POST["int_max_tallers_any"].'", "'.$_POST["int_sugg"].'", "'.$_POST["int_duracio_activitat"].'", "'.$_POST["int_duracio_preparacio"].'","'.$dispany.'");';
                     
                 }
            
                
            //  --------------------------  INSERIM DADES VISIBLES DE LA ACTIVITAT  -----------------------------
            
            $res=$con->exec($sql); 
            
            
            //  --------------------------  INSERIM DADES EN PARTICIPANTS_ACTIVITATS  -----------------------------

                for($i=0;$i<4;$i++)
                {
                    if($_POST["personal_implicat".$i]!=="")
                    {

                        $sql2 = 'INSERT INTO `participants_activitats` (`nom_participant`,`activitats_id`) VALUES ("'.$_POST["personal_implicat".$i].'","'.$_POST["id"].'");';
                        $res2=$con->exec($sql2);
                        
                       


                    }
                }

            
            
           //  --------------------------  INSERIM DNI I DEPARTAMENT EN ACTIVITAT  ----------------------------- 
            
           $sel3 = "SELECT 340_personal.*,340_personal_epsevg.departament FROM 340_personal,340_personal_epsevg where 340_personal.dni=340_personal_epsevg.dni and 340_personal_epsevg.incid='A' order by nom;";
           $res3 = $con->query($sel3);
           $res3=$res3->fetchAll();
           
           foreach($res3 as $fila)
             {
                 if($fila["nom"]." ".$fila["cognoms"]===$_POST["responsable"])
                 {
                     $sql3 = 'update activitats set dni="'.$fila["dni"].'", departament="'.$fila["departament"].'" where activitats.id="'.$_POST["id"].'";';
                     $res3=$con->exec($sql3);
                     
                   

                 }
             }
            
            
            
            //  --------------------------  MISSATGE D'ERROR PER A LA ZONAPRIVADA.PHP  ----------------------------- 
            
             
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
            echo "<h3>Les credencials no son vàlides</h3><div id='tornar'><a href='index.php' title='Tornar a Index'><img src='vista/imatges/home.jpg'></a></div>";
            $_SESSION=[];
            session_destroy();
        }
            
        ?>    
            
        
            
            
            
        </div>
    </body>
</html>