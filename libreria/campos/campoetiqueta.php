<?php
if (!($this->imprpt))
	   {

	   //No impresión

				if (!($this->fie_tactive))
				{
					$this->fie_title="";
				}
				if (@$this->contenid[$nombre_campo]<>"")	
				{

						if($this->fie_inactivoftabla)
						{			 
						 echo $nombre_campo;
						}
						else
						{
						 echo '<div class="form-group">';
						 echo'<label class="control-label col-xs-2" id="'.$nombre_campo.'_html" >'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
						 echo '</div>';
						}					 			 

				}
				else
				{							 
			           if($this->fie_inactivoftabla)
			            {			 
			              echo $nombre_campo;
						}
						else
						{
						 echo '<div class="form-group">';	
						 echo'<div class="col-xs-12" style="background-color:#000033;color:#FFFFFF" id="'.$nombre_campo.'_html" >'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</div>';
						 echo '</div>';
						}				 
				}



		//Fin no impresión

		}
		else
		{

		//Impresión


              if (!($this->fie_tactive))
				{
					$this->fie_title="";
				}
				if (@$this->contenid[$nombre_campo]<>"")	
				{

						if($this->fie_inactivoftabla)
						{			 
						 echo $nombre_campo;
						}
						else
						{
						 echo '<div class="form-group">';
						 echo'<label class="control-label col-xs-2" id="'.$nombre_campo.'_html" >'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</label>';
						 echo '</div>';
						}					 			 

				}
				else
				{							 
			           if($this->fie_inactivoftabla)
			            {			 
			              echo $nombre_campo;
						}
						else
						{
						 echo '<div class="form-group">';	
						 echo'<div class="col-xs-12" style="background-color:#000033;color:#FFFFFF" id="'.$nombre_campo.'_html" >'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</div>';
						 echo '</div>';
						}				 
				}

		

		//Fin impresión

		}

?>