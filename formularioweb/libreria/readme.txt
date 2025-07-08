/**************************************************************************

        Script: PaginaZ v1.1
        Fecha: Septiembre del 2002


        Autor: Zubyc (webmaster@php-hispano.net)

        Este script se encarga de paginar una tabla de una base de datos,
        diviendo los registros en p�ginas de un tama�o definido.
        Servir�a tanto para paginar resultados de b�squedas como noticias,
        im�genes,...
 
        Recuerdo que este script no muestra la informaci�n obtenida ya que 
        simplemente te devuelve los datos de la consulta. 
        Por esto, deber�s ser t� quien se encargue de darle formato a esa 
        consulta, adapt�ndola a una tabla o de cualquier otra forma que 
        se te ocurra..


        Para cualquier sugerencia o error, contactad conmigo a trav�s de:
       
                       webmaster@php-hispano.net


        Podr�s encontrar m�s scripts, tutoriales y manuales sobre �ste y otros temas en
        la web de PHP PARA TORPES:
 
                     http://php-hispano.net


****************************************************************************/


    Requisitos m�nimos

    - Se requiere disponer de un servidor web con capacidad para PHP y MySQL.
    - Es MUY conveniente tener ciertos conocimientos de PHP para hacer funcionar 
      todo correctamente.



     Mejoras en la versi�n 1.1

        - Arreglado un peque�o fallo al crear el n�mero de enlaces
        - Se han a�adido las siguientes funcionas para modificar los colores
             de ciertas partes del script:

                   set_color_tabla($color);
                   set_tabla_transparente()
                   set_color_texto($color)
                   set_color_enlaces($color_inactivo,$color_activo)


****************************************************************************



    Los pasos a seguir para instalar el paginador son los siguientes:


    1) Copiar el archivo class.paginaZ.php en un directorio cualquiera de tu web.
       Si tienes alg�n directorio donde tengas m�s clases seria aconsejable copiarlo 
       aqui, en caso contrario lo m�s adecuado ser�a copiarlo en el directorio donde
       se encuentren los archivos que hagan uso de esta clase.

       Edita este archivo (class.paginaZ.php), y rellena los datos de configuraci�n
       para conectar a la base de datos.

      ---------------------------------------------------------------------------

    2) Crear un fichero que se encargue de mostrar la informaci�n obtenida. Como ejemplo,
       puedes crear un archivo llamado "mostrar_info.php".
       En este archivo deber�s incluir las siguientes l�neas en el orden especificado 
       justo al principio del fichero:

       ------------------------------------------------------------------------

         <? 
          
          include("class.paginaZ.php");

          $page=new sistema_paginacion($nombre_tabla);
          $page->set_condicion($condicion_sql);
          $page->ordenar_por($campo);

          $page->set_limite_pagina(30);
         
          $result_page=$page->obtener_consulta();

         ?>

       ------------------------------------------------------------------------


      A continuaci�n describimos estas funciones:


           include("class.paginaZ.php");  
 
            --> Incluye la clase en el archivo actual.

         
           $page=new sistema_paginacion($nombre_tabla);
          
            --> Crea una instancia de la clase. 
                Par�metro: Nombre de la tabla de la BD que deseamos paginar.

          
           $page->set_condicion($condicion_SQL); 

           --> Esta linea es opcional. S�lo se debe incluir si deseas 
               que s�lo se muestren algunos registros. Es una extension 
               a la consulta SQL.
 
               Ejemplo: campos de la tabla: edad y color_pelo
               
                      Deseamos mostrar s�lo aquellas personas con m�s de 25 y morenas:      
               
                          $page->set_condicion("WHERE edad>25 and color_pelo='morena'");
               

           $page->ordenar_por($campo);
           
           --> Esta l�nea tambi�n es opcional. 
               Acepta como par�metro el nombre de un campo de la tabla por el cual
               se ordenar�n los datos.
               En caso de omitir esta l�nea, los datos ser�n ordenados por el campo
               establecido por defecto.


          $page->set_limite_pagina($numero_por_pagina);

           --> Esta l�nea si es obligatoria. Se deben establecer el n�mero de registros
               a mostrar por p�gina. 
                                     

          $result_page=$page->obtener_consulta();
 
          --> L�nea obligatoria y pr�cticamente la m�s importante. 
              En $result_page devolver� el resultado de la consulta realizada. 
              Es decir, s�lo tienes que limitarte a mostrar los datos:
 
                        $result_page=$page->obtener_consulta();

			/* Codigo intermedio */

                        while($row=mysql_fetch_object($result_page))
                        {
                           /* Mostrar datos */
                        }


	Funciones a�adidas:
        ---------------------------------
        $page->set_color_tabla("yellow");

        --> Es posible que deseeis reutilizar el archivo para realizar varios paginados
            con distinta informaci�n pero ocurre que si modificais el archivo, los colores
            de las tablas ser�n iguales para todos. Esta funci�n se ha introducido para
            permitiros cambiar el color de fondo de las tablas.

            Los colores son introducidos como si se usara la propiedad bgcolor:

            Ejemplos de colores: "yellow","black","#306090",...

 
	
        $page->set_tabla_transparente()

        --> Esta funci�n debes llamarla si deseas que las tablas creadas por el script tomen
	    el color de fondo de la p�gina. 


         $page->set_color_texto($color)
 
        --> Usado para elegir un color para el texto normal 
            (El color de los enlaces no se ver� afectado)

         
         $page->set_color_enlaces($color_inactivo,$color_activo)
         
	--> Si quereis modificar los colores de los enlaces podeis hacerlo llamando a
            esta funci�n. 
            - El primer par�metro indica el color cuando el enlace no esta activo, es decir
              que el raton no est� sobre �l
            - El segundo par�metro sirve para establecer el color que tomar� el enlace                    cuando el rat�n pase por encima.


  
       -------------------------------------------------------------------------
        3. El codigo encargado de listar los registros en pantalla deber� 
           ser realizado por ti mismo. Por eso es conveniente realizar esa parte 
           en este paso.

           Para mostrar los registros de la consulta por pantalla, con esto bastar�a:

		while($row=mysql_fetch_object($result_page))
                        {
                           echo "$row->campo_de_la_tabla<br>"
                        } 

           Pero lo m�s c�modo y elegante como sabr�s, es mostrar toda 
           la informaci�n dividida en varias columnas usando una tabla.
           Bueno, el modo en el que realices esta parte ya depende de los 
           gustos del programador. 


        --------------------------------------------------------------------------


        4. Una vez realizado todo esto, el tercer y �ltimo paso ser�a colocar los enlaces a 
           las otras p�ginas. Para esto s�lo tienes que a�adir las siguientes l�neas 
           en el archivo en el lugar que m�s conveniente te resulte: 


          <? $page->mostrar_numero_pagina() ?>

          Muestra por pantalla un mensaje del tipo:    "P�gina 1 de 4"

          Esta l�nea es un tanto opcional, aunque resulta bastante �til para que los 
          usuarios de la web tengan conocimiento de la p�gina en la que se encuentran.
       


          <? $page->mostrar_enlaces(); ?>

          Muestra los enlaces a otras p�ginas. 
          Se muestran de la forma siguiente: Paginas 1 - 2 - 3 - 4... >> Siguiente
 
          Esta l�nea es OBLIGATORIA. 

	-------------------------------------------------------------------------



         Bueno, espero que haciendo todo esto consigais hacer funcionar el paginado 
         a la primera :)

         Recordad que cualquier error mostrado por pantalla referido a MySQL, ser� 
         debido probablemente a alg�n error en los datos de configuraci�n de la base de 
         datos o bien por alg�n fallo en el nombre de campo de ordenaci�n o en las 
         condiciones. S�lo teneis que revisar estos datos. 







         Si cualquiera de vosotros ha realizado alg�n script de este tipo o sobre 
         cualquier otro tema relacionado con PHP, si lo considera �til y quiere darlo a 
         conocer a otras personas para que podamos aprender de �l, estaremos encantados
         de publicarlo en
                            http://php-hispano.net
         
          
         Un saludo y suerte! ;)

          

          
          
         