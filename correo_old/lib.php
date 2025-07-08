<?php
function datos_empresa($emp_id,$DB_gogess)
{
$datos_emp='';
$datos_empresa="select * from factura_empresa where emp_id=".$emp_id;
						   $rs_empresa = $DB_gogess->Execute($datos_empresa);
						   if($rs_empresa)
						   {
								while (!$rs_empresa->EOF) {
								
								  $datos_emp["emp_nombre"]=$rs_empresa->fields["emp_nombre"];
								  $datos_emp["emp_ruc"]=$rs_empresa->fields["emp_ruc"];
								  $datos_emp["emp_direccion"]=$rs_empresa->fields["emp_direccion"];
								  $datos_emp["emp_logo"]=$rs_empresa->fields["emp_logo"];
								
								
								
								 $rs_empresa->MoveNext();
								}	
						   }


return $datos_emp;
}

function  guarda_emaillog($datos,$DB_gogess)
{

  $inserta_log="insert into factura_reporteemail (repem_tipodoc,repem_numdoc,repem_email,repem_claveacceso,repem_nautorizacion,repem_fechaautorizacion,repem_envio,repem_fechaenvio,repem_mensaje,repem_emailnovalido) values ('".$datos["repem_tipodoc"]."','".$datos["repem_numdoc"]."','".$datos["repem_email"]."','".$datos["repem_claveacceso"]."','".$datos["repem_nautorizacion"]."','".$datos["repem_fechaautorizacion"]."','".$datos["repem_envio"]."','".$datos["repem_fechaenvio"]."','".$datos["repem_mensaje"]."','".$datos["repem_emailnovalido"]."')";
  
  $DB_gogess->Execute($inserta_log);
  //echo $inserta_log;
}


?>