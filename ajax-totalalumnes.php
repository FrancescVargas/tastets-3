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
       
    $sel="SELECT solicituts.centre,activitats_fetes.data,estu_activitats.*,activitats.nom from activitats_fetes,solicituts,activitats,estu_activitats where solicituts.id=activitats_fetes.solicitut_id and activitats.id=activitats_fetes.activitat_id and estu_activitats.activitats_fetes_id=activitats_fetes.id and solicituts.activitat_id=".$_GET["id"].";";
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
