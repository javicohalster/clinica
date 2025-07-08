<?php
//---------------------------
function enviar_correo($mail_asunto,$archivos,$lista_email,$nombredestinatario,$correode,$nombrede,$texto_valor,$email_extra,$DB_gogess)
{
$buscadatosemail="select * from  gogess_correo where corre_id=1";
$rs_buscacorreo = $DB_gogess->Execute($buscadatosemail); 
//print_r($rs_buscacorreo->fields);
//print_r($archivos);

#Configuracion
$Parametros["plugin"]="PHPMailer";
#$Parametros["Servidor_Correo"]="gmail";
$Parametros["Servidor_Correo"]="gmail";
#Instanciamiento
$correo=new cjEmail($Parametros);

$correo->mail->Host = $rs_buscacorreo->fields["corre_smtp"];
$correo->mail->Username = $rs_buscacorreo->fields["corre_email"];#"amceesystems@gmail.com";
$correo->mail->Password = $rs_buscacorreo->fields["corre_clave"];	
	
try {
$correo->mail->From = $rs_buscacorreo->fields["corre_email"];
$correo->mail->FromName = $rs_buscacorreo->fields["corre_titulo"];
$correo->mail->Timeout=120;



$contEnvio=1;


        $textHTML="
        <table border=\"0\">
            <tr><td align=\"center\"><b>ENVIO DE COMPROBANTES ELECTRONICOS</b></td></tr>
           ";

        
        $textHTML.="
            <tr>
                <td align=\"justify\">
                   
                    <p>
                        ".$rs_buscacorreo->fields["corre_mensaje"].".			
						
                    </p>
                    ";

        
        $textHTML.="
        <tr>
            <td align=\"justify\">
                <p>
                    
					
		
				
					
                </p>                
            </td>
        </tr>";

        $textHTML.="
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr><td align=\"center\">&nbsp;</td></tr>
        <tr>
            <td align=\"center\">
                <b>...</b><br>
            </td>
        </tr>
        </table>";

       
		
		$destinatario=$lista_email[0];
		echo "Destinatario:".$destinatario."<br>";



        $correo->mail->CharSet = 'UTF-8';
        $correo->mail->Subject=$mail_asunto;
        $correo->mail->MsgHTML($textHTML);
        $correo->mail->AddAddress($destinatario,$nombredestinatario);	
		
		
		for($iem=1;$iem<count($lista_email);$iem++)
		{
			if($lista_email[$iem])
			{
			$correo->mail->AddCC($lista_email[$iem]);
			}
			echo $lista_email[$iem]."<br>";
		}
			
		
				
        $correo->mail->IsHTML(true);	
		
		for($iat=0;$iat<count($archivos);$iat++)
		{
		  $correo->mail->AddAttachment($archivos[$iat]["path"],$archivos[$iat]["nombre"]);
		}
		
		$result = $correo->mail->Send();
		 if(isset($result)) {
			   $msgresultado=1;
		 }
		 else
		 {
			  $msgresultado=0;
			 
		 }
	
	
	    $correo->mail->ClearAddresses();
        @$correo->mail->ClearAddresses();
		   
		}catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}
		 
	return $msgresultado;
}
?>