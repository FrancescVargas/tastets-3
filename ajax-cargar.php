<?php
session_start();
    header('Content-type: application/json; charset=utf-8');
   if(isset($_GET["id"]))
    {   
        try{
            $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
       
    $sel="SELECT * from activitats where activitats.id=".$_GET["id"].";";
    $res=$con->query($sel);
       
    $dat=$res->fetch();
  
      
    $sel3="select * from participants_activitats where activitats_id=".$_GET["id"].";";
    $res3=$con->query($sel3);       
    if($res3) $dat["participants"]=$res3->fetchAll();
    else $dat["participants"]="";
       
    $sel4="SELECT nomdep from 340_departaments_upc,activitats where 340_departaments_upc.codidep=activitats.departament and activitats.id=".$_GET["id"].";";
    $res4 = $con->query($sel4);
    if($res4) $dat["dep"]=$res4->fetch();
    else $dat["dep"]="";
      
   echo json_encode($dat);
      
       
   }
?>