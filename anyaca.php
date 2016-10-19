<?php


function anyaca($data)
{    
//$r=implode("-", $data);
list($any, $mes, $dia) = explode("-", $data);
if($mes<9) $anyaca=$any-1;
else $anyaca=$any;
return $anyaca;
}



?>