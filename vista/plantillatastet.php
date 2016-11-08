<!doctype html>
<html lang="es">
    <head>
         <?php $rest = substr($data["ruta"], 0, -15); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Detalls Tastet</title>
        <?php echo '<link rel="stylesheet" type="text/css" href="'.$rest.'css/estils.css">'; ?>
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <?php echo '<img id="logo" src="'.$rest.'vista/imatges/logo2.jpg" alt="logo">'; ?>
            <?php echo '<img id="imatgeheader" src="'.$rest.'vista/imatges/capcalera_recurs_8.jpg">'; ?>
            <?php echo '<form method="post" action="'.$rest.'zonaprivada.php" id="identificador">'; ?>
                
                <input type="text" name="perfil" placeholder="perfil">
             
                <input type="password" name="dni" placeholder="password">
                <button type="submit">Accedir a la Zona Privada</button><br>
            <?php echo '</form>'; ?>
            
        </header>
        
    <div id="contenedor">
        
   
       
        
    <?php
   
     
      
        
        echo "<div id='descripcio'><img id='fotodesc' src='".$rest.$data["foto"]."'><h2>".$data["nom"]."</h2><p>
        ".$data["descripcio"]."</p></div>";
        
        
      
        echo "<div id='detalls'>
        <h3><span>Responsable: </span><br>".$data["responsable"]."<br><span>Departament:</span><br>".
        $data["dep"]["nomdep"]."<br>
        <span>Lloc: </span>".$data["lloc"]."<br><span>Disponibilitat: </span> ".$data["prova_intdispany"]."<br><span>Nivell mínim de formació per fer el taller: </span> ".$data["int_nivell"]."<br><span>Màxim d'alumnes per sessió: </span> ".$data["int_maxim_alu"]."</h3><div><a href='".$rest."index.php' title='Tornar a Index'><img src='".$rest."vista/imatges/home.jpg'></a></div></div>";
        
       
        
           echo '<div id="forminscripcio">';
         if(!isset($_GET["inscrit"]))
        { 
               
                echo '<form id="formescondido" method="post" action="'.$data["ruta"].'/publicoment">

                <input type="hidden" name="id_activitat" value="'.$data["id"].'"><h4>Formulari d\'Inscripció</h4><br>
                <label>Nom i Cognoms: </label><br><input type="text" name="nomicognoms"><br>
                <label>Centre: </label><br><input type="text" name="centre" required><br>
                <label>Número d\'estudiants aproximats: </label><br><input type="number" class="inputshort" name="estuaprox"><br>
                <label>Email: </label><br><input type="email" name="email" required><br>
                <label>Telèfon: </label><br><input type="tel" name="telefon" required><br>
                <label>Comentari: </label><br><textarea rows="5" cols="30" name="comentari"> </textarea><br>

                 <p><input type="submit" value="confirmar"></p>
                 </form>
                 </div>';
       }
        else
        {
            echo "<h3>La inscripció s'ha realitzat amb éxit</h3></div>";
        }
        
        
        
        
        
       
        
        ?> 
        
        
   
        </div>  
        
       
    
    </body>




</html>