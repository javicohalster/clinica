<?php
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {
             printf("<tr><td valign=top><div  class='%s'>%s</div></td><td>&nbsp;</td><td>&nbsp;</td><td valign='top'>&nbsp;<input name='%s' type='password' class='%s'  maxlength='%s' value='%s' size='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$len,$this->contenid[$nombre_campo],$this->fie_lencampo);
			 printf("<tr><td valign=top><div  class='%s'>Confirmación %s</div></td><td>&nbsp;</td><td>&nbsp;</td><td valign=top>&nbsp;<input name='%s1' type='password' class='%s'  maxlength='%s' value='%s' size='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$len,$this->contenid[$nombre_campo],$this->fie_lencampo);
			 
           }
          else
           {
			 printf("<tr><td valign=top><div  class='%s'>%s</div></td><td> &nbsp;</td><td> &nbsp;</td><td valign=top>&nbsp;<input name='%s' type='password' class='%s'  maxlength='%s' size='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$len,$this->fie_lencampo);
			 printf("<tr><td valign=top><div  class='%s'>Confirmación %s</div></td><td>&nbsp;</td><td>&nbsp;</td><td valign=top>&nbsp;<input name='%s1' type='password' class='%s'  maxlength='%s' size='%s'></td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_styleobj,$len,$this->fie_lencampo);
           }
?>