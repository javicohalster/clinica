<?php

$texto_extra='';

if($this->fie_placeholder)

{

$placeholder=$this->fie_placeholder;

}else

{

$placeholder=$this->fie_title;



}

  if (!($this->imprpt))

	   {

	   //No impresión

		if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

		  if (!(@$this->contenid[$nombre_campo]==""))

           {						  

			

			if($this->fie_inactivoftabla)

			{

			echo '<textarea name="'.$nombre_campo.'" id="'.$nombre_campo.'" class="'.$this->fie_styleobj.'" rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->contenid[$nombre_campo].'</textarea>';

			}

			else

			{

			

			

			

			 echo '<div class="form-group">';

			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			 echo '<div class="col-xs-5">';

			 echo '<textarea placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->contenid[$nombre_campo].'</textarea>';

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

          else

  		   {

            if ($this->fie_sendvar)				

             {

 				  

			  

			   if($this->fie_inactivoftabla)

			{

			echo '<textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->sendvar["$this->fie_sendvar"].'</textarea>';

			}

			else

			{

			

			 

			 echo '<div class="form-group">';

			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			 echo '<div class="col-xs-5">';

			 echo '<textarea placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->sendvar["$this->fie_sendvar"].'</textarea>';

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

            else

             {  

 

			  

			     if($this->fie_inactivoftabla)

			{

			echo '<textarea name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->fie_value.'</textarea>';

			}

			else

			{

			

			 

			 echo '<div class="form-group">';

			 echo'<label class="control-label col-xs-5">'.utf8_encode($this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio).'</label>';

			 echo '<div class="col-xs-5">';

			 echo '<textarea placeholder="'.utf8_encode($placeholder).'" name="'.$nombre_campo.'" class="'.$this->fie_styleobj.'"  id="'.$nombre_campo.'"  rows="'.$this->fie_lineas.'" wrap="VIRTUAL" '.$this->fie_attrib.' cols="'.$this->fie_lencampo.'" >'.$this->fie_value.'</textarea>';

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

		//Fin no impresión

		}

		else

		{

		//Impresión

				 if ($this->fie_activarprt)

		 {

		if (!($this->fie_tactive))

        {

			$this->fie_title="";

		}

		if ($this->contenid[$nombre_campo]<>'')

		{

		

		 if($this->fie_inactivoftabla)

			{

			echo $this->contenid[$nombre_campo];

			}

			else

			{

			echo '<tr>

			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>

			 <td valign="top" class="'.$this->fie_style.'" >'.$this->contenid[$nombre_campo].' '.$this->fie_txtextra.'</td>	

			 </tr>';			

			}

		

		

		

			   

		}

		}

		//Fin impresión

		}

?>