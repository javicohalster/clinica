<?php

 if (!($this->imprpt))
	   {
	   //No impresi�n
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
				 
				if (@$this->contenid[$nombre_campo]<>"")	
				{
			
			if($this->fie_inactivoftabla)
			{			 
     		 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->contenid[$nombre_campo],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
			}
			else
			{
				
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'" >';
			 
			 echo'<div class="col-xs-3"  align="right">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</div>';
			 echo '<div class="col-xs-7">';
			 
			 echo '<div class="input-group">';
			 
			 echo '<div id="cmb_'.$nombre_campo.'"  >';
			 
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,trim($this->contenid[$nombre_campo]),$this->fie_sqlorder,$DB_gogess);	
			 echo '</select>';
			 
			 echo '</div>';
			 
			 if($this->fie_activarbuscador==1)
			 {
			  echo '<span class="input-group-btn" style="">
                        <div class="btn btn-sm btn-default btn-file" onclick="buscar_dataform('.$this->fie_id.')" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </span>';
			 }
			 
			 if($this->fie_crear==1)
			 {
			  $comilla="'";
			  echo '<span class="input-group-btn" style="">
                        <div class="btn btn-sm btn-default btn-file" onclick="crear_dataform('.$this->fie_id.',$('.$comilla.'#'.$nombre_campo.$comilla.').val())" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-edit"></i>
                        </div>
                    </span>';
			 }
			 
			 echo '</div>';
			 
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>'; 
			  
			 echo '</div>';
				
				//echo $nombre_campo."=".$this->contenid[$nombre_campo]."<br>";
			
			
			}					 
								 
								 
				}
				else
				{							 
					
					if($this->fie_inactivoftabla)
			{			 
			echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>
			 <option value="">---Seleccionar--</option>';
			  $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,$this->sendvar["$this->fie_sendvar"],$this->fie_sqlorder,$DB_gogess);			 
			 echo '</select>';
				}
				else
				{
				
				
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'">';
			 
			 echo'<div class="col-xs-3"  align="right">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</div>';
			 echo '<div class="col-xs-7">';		 
			
			 echo '<div class="input-group">';
			 
			 echo '<div id="cmb_'.$nombre_campo.'"  >';
			 
			 echo '<select name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" '.$this->fie_attrib.'>';
			 echo '<option value="">---Seleccionar--</option>';
			 $this->fill_cmb($this->fie_tabledb,$this->fie_datadb,@$this->sendvar[$this->fie_sendvar],$this->fie_sqlorder,$DB_gogess);
			 echo '</select>';
			 
			 echo '</div>';
			 
			 if($this->fie_activarbuscador==1)
			 {
			  echo '<span class="input-group-btn" style="">
                        <div class="btn btn-sm btn-default btn-file" onclick="buscar_dataform('.$this->fie_id.')" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-search"></i>
                        </div>
                    </span>';
			 }
			 
			 if($this->fie_crear==1)
			 {
			  $comilla="'";
			  echo '<span class="input-group-btn" style="">
                        <div class="btn btn-sm btn-default btn-file" onclick="crear_dataform('.$this->fie_id.',$('.$comilla.'#'.$nombre_campo.$comilla.').val())" style="cursor:pointer" >
                           <i class="glyphicon glyphicon-edit"></i>
                        </div>
                    </span>';
			 }
			 
	         echo '</div>';
			 
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 
			 echo '</div>';
			 	
				
			 
				}				 
				
				
				}

		//Fin no impresi�n
		}
		else
		{
		//Impresi�n
		 if ($this->fie_activarprt)
		 {
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
				
		if ($this->contenid[$nombre_campo]<>'')
		{	                
		$rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$this->contenid[$nombre_campo],$DB_gogess);
		  
		  		if($this->fie_inactivoftabla)
			{	
			echo $rmp;
			 }
			 else
			 {
			 
			 
		
			 
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'">';
			 echo'<label class="control-label col-xs-3">'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
			 echo '<div class="col-xs-7">';
			 echo  $rmp;
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 	
			 
			 
			 }
	
		}
		}
		//Fin impresi�n
		}
?>