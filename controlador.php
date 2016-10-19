<?php
require "vendor/autoload.php";


$app=new Slim\App();
$c=$app->getContainer(); 

$c["bd"]=function()  
{
    $pdo=new PDO("mysql:host=localhost;dbname=activitats","root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
    return $pdo;
};


$c["view"]=new \Slim\Views\PhpRenderer("vista/"); 

$app->get("/detallsactivitat",function($request,$response,$args)  // sacamos el listado de la búsqueda
          {
              $con=$this->bd; 
              $params=$request->getQueryParams();
            /*  $sql="SELECT * from activitats where activitats.id=".$params['id'].";";
              $res1=$con->query($sql);*/
              $sql="SELECT * from activitats where activitats.id= :params_id;";
              $res1 = $con->prepare($sql);
              $res1->execute([':params_id' =>$params["id"]]);
             
              $datos= $res1->fetch();
              
              $datos["ruta"]=$request->getUri()->getBasePath();
             
              $response=$this->view->render($response,"plantillatastet.php",$datos); 
              return $response;
            
          });


$app->post("/publicoment", function($request,$response,$args)
          {
               try{
                $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
            }catch(PDOException $e){
                echo "<div class='error'>".$e->getMessage()."</div>"; 
                die();
            }
            $con=$this->bd;
            $params=$request->getParsedBody();
            $params['centre']=addslashes($params['centre']);
            $params['comentari']=addslashes($params['comentari']);
            $params['nomicognoms']=addslashes($params['nomicognoms']);
              
            $sql='insert into solicituts(estuaprox,centre,comentari,email,nom_i_cognoms,activitat_id,telefon) values("'.$params['estuaprox'].'","'.$params['centre'].'","'.$params['comentari'].'","'.$params['email'].'","'.$params['nomicognoms'].'","'.$params['id_activitat'].'","'.$params['telefon'].'");';
            $res=$con->exec($sql); 
              
              /*$sql='insert into solicituts(estuaprox,centre,comentari,email,nom_i_cognoms,activitat_id,telefon) values(:$params_estuaprox,:$params_centre,:$params_comentari,:$params_email,:$params_nomicognoms,:$params_id_activitat,:$params_telefon);';
              $res = $con->prepare($sql);
              $res->execute(array(':params_estuaprox' =>$params["estuaprox"],':$params_centre' =>$params["centre"],':$params_comentari'=>$params["comentari"], ':$params_email'=>$params["email"],':$params_nomicognoms'=>$params["nomicognoms"],':$params_id_activitat'=>$params["id_activitat"],':$params_telefon'=>$params["telefon"]));*/
              
             
            
            $to      = $params["email"];
            $subject = 'Sol.licitut Tastet EPSEV';
            $message = $params["nomicognoms"].', gràcies per enviar-nos la sol.licitud per a aquest tastet. En breu ens posarem en contacte amb tu';
            $headers = 'From: Escola Politècnica Superior d\'Enginyeria de Vilanova i la Geltrú' . "\r\n" .
            'Reply-To: fravase76@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

              mail($to, $subject, $message, $headers);
              
              
             $datos=$request->getUri()->getBasePath();
            return $response->withRedirect($datos.'/detallsactivitat?id='.$params['id_activitat'].'&inscrit=si');
              
              
          });
          

$app->run();
?>