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
                 if($_SESSION["perfil"]==="A") echo "<label>Id</label><input type='number' name='id' value='${res['id']}'><br>";
                 if($_SESSION["perfil"]==="B") echo "<input type='hidden' name='id' value='${res['id']}'>";
                 echo '<label>Nom</label> <br><input type="text" class="inputlong" name="nom" value="'.$res['nom'].'"><br>';
                 echo '<label>Responsable</label> <br>';
                
                 
                $sel3 = "SELECT 340_personal.* FROM 340_personal,340_personal_epsevg where 340_personal.dni=340_personal_epsevg.dni and 340_personal_epsevg.incid='A' order by nom;";
                $res3 = $con->query($sel3);
                $res3=$res3->fetchAll();

                echo "<select name='responsable'>";

                foreach($res3 as $fila)
                 {
                    if($res['responsable']==$fila["nom"]." ".$fila["cognoms"]) echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."' selected>".$fila["nom"]." ".$fila["cognoms"]."</option>";  

                    else echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."'>".$fila["nom"]." ".$fila["cognoms"]."</option>";
                 }


                echo "</select><br>"; 
  
                
                echo '<label>Lloc</label> <br><input class="inputlong" type="text" name="lloc" value="'.$res['lloc'].'"><br>';
                echo "<label>Foto</label><br><img alt='foto'  class='fototastet' src='${res['foto']}'><input type='file' name='foto' ><br>";
                echo '<label>Descripció</label><br><textarea id="mytextarea" rows="8" cols="60" name="descripcio" >'.$res['descripcio'].'</textarea><br>';
                echo "<label>Nombre Màxim d'Alumnes per Sessió</label> <br><input type='number' name='int_maxim_alu' class='inputshort' value='${res['int_maxim_alu']}'><br>";
                echo "<label>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller:</label> <br><input type='text' name='int_nivell' value='${res['int_nivell']}'><br>";
                echo "<fieldset><legend>Períodes de l&#39;any en que està disponible:</legend> <br>";
               
                 
                 $checked=strpos($res["prova_intdispany"], "Intersemestral (Gener-Febrer)");
                 
                 if($checked!==false) echo  '<input type="checkbox" name="dispany1" value="Intersemestral (Gener-Febrer)" 
                 checked>Intersemestral (Gener-Febrer)<br>';
                 else echo  '<input type="checkbox" name="dispany1" value="Intersemestral (Gener-Febrer)" 
                 >Intersemestral (Gener-Febrer)<br>';
                 
                $checked=strpos($res["prova_intdispany"], "Setmanes d’exàmens parcials"); 
                if($checked!==false) echo  '<input type="checkbox" name="dispany2" value="Setmanes d’exàmens parcials" checked>Setmanes d’exàmens parcials<br>';
                else echo  '<input type="checkbox" name="dispany2" value="Setmanes d’exàmens parcials" >Setmanes d’exàmens parcials<br>';
                 
                $checked=strpos($res["prova_intdispany"], "Els dies de JPO"); 
                if($checked!==false) echo  '<input type="checkbox" name="dispany3" value="Els dies de JPO" checked>Els dies de JPO<br>';
                else echo  '<input type="checkbox" name="dispany3" value="Els dies de JPO">Els dies de JPO<br>';
                
                 
                $checked=strpos($res["prova_intdispany"], "Durant tot l'any"); 
                if($checked!==false) echo  '<input type="checkbox" name="dispany4" value="Durant tot l\'any" checked>Durant tot l&#39;any<br>';
                else echo  '<input type="checkbox" name="dispany4" value="Durant tot l&#39;any">Durant tot l&#39;any<br>';
                 
                $checked=strpos($res["prova_intdispany"], "Altres");
                if($checked!==false) echo  '<input type="checkbox" name="dispany5" value="Altres" checked>Altres<br>';
                else echo  '<input type="checkbox" name="dispany5" value="Altres">Altres<br>';
                 
                echo "</fieldset>";
                echo "</fieldset>";
                echo "<fieldset><legend>Informació Interna:</legend><br>";
                
                echo "<label>Comentaris Generals</label> <br><textarea  rows='8' cols='60' name='int_comentari' > ${res['int_comentari']}</textarea><br>";
                echo "<label>Quantitat màxima de tallers en un any acadèmic:</label> <br><input type='number' class='inputshort' name='int_max_tallers_any' value='${res['int_max_tallers_any']}'><br>";
                echo "<label>Duració de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_activitat' value='${res['int_duracio_activitat']}'><br>";
                echo "<label>Temps de preparació de l'activitat (hores) </label> <br><input type='number' class='inputshort' name='int_duracio_preparacio' value='${res['int_duracio_preparacio']}'><br>";
                echo "<label>Personal Implicat</label> <br>";
                 
             $sql4="select nom_participant from participants_activitats where activitats_id=".$res["id"].";";
             $res4 = $con->query($sql4);
             $res4=$res4->fetchAll();
                 
             
                 for($i=0;$i<5;$i++)
        {
            echo "<select name='personal_implicat".$i."'>";
            echo "<option value='' selected>Buit</option>";
            foreach($res3 as $fila)
         {
             if($res4[$i]["nom_participant"]== $fila["nom"]." ".$fila["cognoms"]) echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."' selected>".$fila["nom"]." ".$fila["cognoms"]."</option>";
                
                
            else echo "<option value='".$fila["nom"]." ".$fila["cognoms"]."' >".$fila["nom"]." ".$fila["cognoms"]."</option>"; 
         }


        echo "</select><br>";  
        }
                 
                 
                echo "<label>Suggeriments i comentaris:</label><br><textarea rows='8' cols='60' name='int_sugg' > ${res['int_sugg']}</textarea><br>";
                echo "</fieldset>";

                echo "<p><input type='submit' value='modificar'></p></form>";
      
             }
            
            
             if(isset($_POST['id']))
             {
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
                        
                        $sql= 'UPDATE activitats SET id = '.$_POST["id"].', nom = "'.$_POST["nom"].'", responsable = "'.$_POST["responsable"].'", lloc = "'.$_POST["lloc"].'", descripcio = "'.$_POST["descripcio"].'", foto = "'.$f.'", int_comentari= "'.$_POST["int_comentari"].'", int_maxim_alu= "'.$_POST["int_maxim_alu"].'", int_nivell= "'.$_POST["int_nivell"].'", int_max_tallers_any= "'.$_POST["int_max_tallers_any"].'", int_sugg= "'.$_POST["int_sugg"].'", int_duracio_activitat="'.$_POST["int_duracio_activitat"].'", int_duracio_preparacio="'.$_POST["int_duracio_preparacio"].'",prova_intdispany="'.$dispany.'" WHERE activitats.id ='.$_POST["id_anterior"].';';
                    }

                   
             
                 else
                 {
                   $sql= 'UPDATE activitats SET id = '.$_POST["id"].', nom = "'.$_POST["nom"].'", responsable = "'.$_POST["responsable"].'", lloc = "'.$_POST["lloc"].'", descripcio = "'.$_POST["descripcio"].'", int_comentari= "'.$_POST["int_comentari"].'", int_maxim_alu= "'.$_POST["int_maxim_alu"].'", int_nivell= "'.$_POST["int_nivell"].'", int_max_tallers_any= "'.$_POST["int_max_tallers_any"].'", int_sugg= "'.$_POST["int_sugg"].'", int_duracio_activitat="'.$_POST["int_duracio_activitat"].'", int_duracio_preparacio="'.$_POST["int_duracio_preparacio"].'",prova_intdispany="'.$dispany.'" WHERE activitats.id ='.$_POST["id_anterior"].';';
                 }
                 
                 
                 
                
                 $res=$con->exec($sql); 
                 
                 if($res===false) $_SESSION["error"]="No s'ha pogut editar el tastet ".$_POST["nom"];
                 else $_SESSION["error"]="Editat tastet ".$_POST["nom"];
                 
                 $sql5= 'DELETE from participants_activitats where activitats_id='.$_POST["id"].';'; 
                 $res5=$con->exec($sql5);
                 
                
                 
                 for($i=0;$i<5;$i++)
                {
                    if($_POST["personal_implicat".$i]!=="")
                    {

                        $sql6 = 'INSERT INTO `participants_activitats` (`nom_participant`,`activitats_id`) VALUES ("'.$_POST["personal_implicat".$i].'","'.$_POST["id"].'");';
                        $res6=$con->exec($sql6);
                    }
                   
                }

                 
              $sel7 = "SELECT 340_personal.*,340_personal_epsevg.departament FROM 340_personal,340_personal_epsevg where 340_personal.dni=340_personal_epsevg.dni and 340_personal_epsevg.incid='A' order by nom;";
             $res7 = $con->query($sel7);
             $res7=$res7->fetchAll();

            foreach($res7 as $fila)
             {
                 if($fila["nom"]." ".$fila["cognoms"]===$_POST["responsable"])
                 {
                     $sql3 = 'update activitats set dni="'.$fila["dni"].'", departament="'.$fila["departament"].'" where activitats.id="'.$_POST["id"].'";';
                     $res3=$con->exec($sql3);

                 }
             }
                 
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