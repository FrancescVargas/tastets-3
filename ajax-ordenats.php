 <?php
session_start();
    header('Content-type: application/json; charset=utf-8');
if(isset($_GET["campo"]))
{    
        try{
            $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
       
  
if($_SESSION["perfil"]=="B") $sel="SELECT estu_activitats.dni_estu,estu_activitats.nom_estu,estu_activitats.mail_estu,solicituts.centre,activitats.nom,activitats_fetes.data,activitats_fetes.anyaca as Any_Academic from activitats,activitats_fetes,solicituts,estu_activitats where estu_activitats.activitats_fetes_id=activitats_fetes.id AND activitats_fetes.solicitut_id=solicituts.id AND solicituts.activitat_id=activitats.id and activitats.dni='".$_SESSION["dni"]."' order by ".$_GET["campo"].";";
if($_SESSION["perfil"]=="A") $sel="SELECT estu_activitats.dni_estu,estu_activitats.nom_estu,estu_activitats.mail_estu,solicituts.centre,activitats.nom,activitats_fetes.data,activitats_fetes.anyaca as Any_Academic from activitats,activitats_fetes,solicituts,estu_activitats where estu_activitats.activitats_fetes_id=activitats_fetes.id AND activitats_fetes.solicitut_id=solicituts.id AND solicituts.activitat_id=activitats.id order by ".$_GET["campo"].";";


$res=$con->query($sel);
$dat=$res->fetchAll();
if(count($dat)>0)
   {
       for($i=0;$i<count($dat);$i++)
       {
           foreach($dat[$i] as $clave=>$valor)
           {
               if(!is_numeric($clave)) $dato[$i][$clave]=$valor;

           }
       }
       $dat=$dato;
        echo json_encode($dat);

   }
else 
  {
      $dat="No Hi han tastets fets";
      echo json_encode($dat);
  }
     
}
   
?>