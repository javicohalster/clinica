<?php

/**
* MIT License
* ===========
*
* Copyright (c) 2012 Ing. Mauricio Lopez <mlopez@dixian.info>
*
* Permission is hereby granted, free of charge, to any person obtaining
* a copy of this software and associated documentation files (the
* "Software"), to deal in the Software without restriction, including
* without limitation the rights to use, copy, modify, merge, publish,
* distribute, sublicense, and/or sell copies of the Software, and to
* permit persons to whom the Software is furnished to do so, subject to
* the following conditions:
*
* The above copyright notice and this permission notice shall be included
* in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
* OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
* IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
* TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
* SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*
* @package ValidarIdentificacion
* @subpackage
* @author Ing. Mauricio Lopez <mlopez@dixian.info>
* @copyright 2012 Ing. Mauricio Lopez (diaspar)
* @license http://www.opensource.org/licenses/mit-license.php MIT License
* @link http://www.dixian.info
* @version @@0.8@@
*/

/**
* ValidarIdentificacion contiene metodos para validar c�dula, RUC de persona natural, RUC de sociedad privada y
* RUC de socieda p�blica en el Ecuador.
*
* Los m�todos p�blicos para realizar validaciones son:
*
* validarCedula()
* validarRucPersonaNatural()
* validarRucSociedadPrivada()
*/
class ValidarIdentificacion
{

    /**
* Error
*
* Contiene errores globales de la clase
*
* @var string
* @access protected
*/
    protected $error = '';

    /**
* Validar c�dula
*
* @param string $numero N�mero de c�dula
*
* @return Boolean
*/
    public function validarCedula($numero = '')
    {
        // fuerzo parametro de entrada a string
        $numero = (string)$numero;

        // borro por si acaso errores de llamadas anteriores.
        $this->setError('');

        // validaciones
        try {
            $this->validarInicial($numero, '10');
            $this->validarCodigoProvincia(substr($numero, 0, 2));
            $this->validarTercerDigito($numero[2], 'cedula');
            $this->algoritmoModulo10(substr($numero, 0, 9), $numero[9]);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }
   
    /**
* Validar RUC persona natural
*
* @param string $numero N�mero de RUC persona natural
*
* @return Boolean
*/
    public function validarRucPersonaNatural($numero = '')
    {
        // fuerzo parametro de entrada a string
        $numero = (string)$numero;

        // borro por si acaso errores de llamadas anteriores.
        $this->setError('');

        // validaciones
        try {
            $this->validarInicial($numero, '13');
            $this->validarCodigoProvincia(substr($numero, 0, 2));
            $this->validarTercerDigito($numero[2], 'ruc_natural');
            $this->validarCodigoEstablecimiento(substr($numero, 10, 3));
            $this->algoritmoModulo10(substr($numero, 0, 9), $numero[9]);
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }


    /**
* Validar RUC sociedad privada
*
* @param string $numero N�mero de RUC sociedad privada
*
* @return Boolean
*/
    public function validarRucSociedadPrivada($numero = '')
    {
        // fuerzo parametro de entrada a string
        $numero = (string)$numero;

        // borro por si acaso errores de llamadas anteriores.
        $this->setError('');

        // validaciones
        try {
            $this->validarInicial($numero, '13');
            $this->validarCodigoProvincia(substr($numero, 0, 2));
            $this->validarTercerDigito($numero[2], 'ruc_privada');
            $this->validarCodigoEstablecimiento(substr($numero, 10, 3));
            $this->algoritmoModulo11(substr($numero, 0, 9), $numero[9], 'ruc_privada');
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }

    /**
* Validar RUC sociedad publica
*
* @param string $numero N�mero de RUC sociedad publica
*
* @return Boolean
*/
    public function validarRucSociedadPublica($numero = '')
    {
        // fuerzo parametro de entrada a string
        $numero = (string)$numero;

        // borro por si acaso errores de llamadas anteriores.
        $this->setError('');

        // validaciones
        try {
            $this->validarInicial($numero, '13');
            $this->validarCodigoProvincia(substr($numero, 0, 2));
            $this->validarTercerDigito($numero[2], 'ruc_publica');
            $this->validarCodigoEstablecimiento(substr($numero, 9, 4));
            $this->algoritmoModulo11(substr($numero, 0, 8), $numero[8], 'ruc_publica');
        } catch (Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }
   
    /**
* Validaciones iniciales para CI y RUC
*
* @param string $numero CI o RUC
* @param integer $caracteres Cantidad de caracteres requeridos
*
* @return Boolean
*
* @throws exception Cuando valor esta vacio, cuando no es d�gito y
* cuando no tiene cantidad requerida de caracteres
*/
    protected function validarInicial($numero, $caracteres)
    {
        if (empty($numero)) {
            throw new Exception('Valor no puede estar vacio');
        }
        
        if (!ctype_digit($numero)) {
            throw new Exception('Valor ingresado solo puede tener d�gitos');
        }

        if (strlen($numero) != $caracteres) {
            throw new Exception('Valor ingresado debe tener '.$caracteres.' caracteres');
        }

        return true;
    }

    /**
* Validaci�n de c�digo de provincia (dos primeros d�gitos de CI/RUC)
*
* @param string $numero Dos primeros d�gitos de CI/RUC
*
* @return boolean
*
* @throws exception Cuando el c�digo de provincia no esta entre 00 y 24
*/
    protected function validarCodigoProvincia($numero)
    {
        if ($numero < 0 OR $numero > 24) {
            throw new Exception('Codigo de Provincia (dos primeros d�gitos) no deben ser mayor a 24 ni menores a 0');
        }

        return true;
    }
    
    /**
* Validaci�n de tercer d�gito
*
* Permite validad el tercer d�gito del documento. Dependiendo
* del campo tipo (tipo de identificaci�n) se realizan las validaciones.
* Los posibles valores del campo tipo son: cedula, ruc_natural, ruc_privada
*
* Para C�dulas y RUC de personas naturales el terder d�gito debe
* estar entre 0 y 5 (0,1,2,3,4,5)
*
* Para RUC de sociedades privadas el terder d�gito debe ser
* igual a 9.
*
* Para RUC de sociedades p�blicas el terder d�gito debe ser
* igual a 6.
*
* @param string $numero tercer d�gito de CI/RUC
* @param string $tipo tipo de identificador
*
* @return boolean
*
* @throws exception Cuando el tercer digito no es v�lido. El mensaje
* de error depende del tipo de Idenficiaci�n.
*/
    protected function validarTercerDigito($numero, $tipo)
    {
        switch ($tipo) {
            case 'cedula':
            case 'ruc_natural':
                if ($numero < 0 OR $numero > 5) {
                    throw new Exception('Tercer d�gito debe ser mayor o igual a 0 y menor a 6 para c�dulas y RUC de persona natural');
                }
                break;
            case 'ruc_privada':
                if ($numero != 9) {
                    throw new Exception('Tercer d�gito debe ser igual a 9 para sociedades privadas');
                }
                break;

            case 'ruc_publica':
                if ($numero != 6) {
                    throw new Exception('Tercer d�gito debe ser igual a 6 para sociedades p�blicas');
                }
                break;
            default:
                throw new Exception('Tipo de Identificacion no existe.');
                break;
        }

        return true;
    }

    /**
* Validaci�n de c�digo de establecimiento
*
* @param string $numero tercer d�gito de CI/RUC
*
* @return boolean
*
* @throws exception Cuando el establecimiento es menor a 1
*/
    protected function validarCodigoEstablecimiento($numero)
    {
        if ($numero < 1) {
            throw new Exception('C�digo de establecimiento no puede ser 0');
        }

        return true;
    }

    /**
* Algoritmo Modulo10 para validar si CI y RUC de persona natural son v�lidos.
*
* Los coeficientes usados para verificar el d�cimo d�gito de la c�dula,
* mediante el algoritmo �M�dulo 10� son: 2. 1. 2. 1. 2. 1. 2. 1. 2
*
* Paso 1: Multiplicar cada d�gito de los digitosIniciales por su respectivo
* coeficiente.
*
* Ejemplo
* digitosIniciales posicion 1 x 2
* digitosIniciales posicion 2 x 1
* digitosIniciales posicion 3 x 2
* digitosIniciales posicion 4 x 1
* digitosIniciales posicion 5 x 2
* digitosIniciales posicion 6 x 1
* digitosIniciales posicion 7 x 2
* digitosIniciales posicion 8 x 1
* digitosIniciales posicion 9 x 2
*
* Paso 2: S� alguno de los resultados de cada multiplicaci�n es mayor a o igual a 10,
* se suma entre ambos d�gitos de dicho resultado. Ex. 12->1+2->3
*
* Paso 3: Se suman los resultados y se obtiene total
*
* Paso 4: Divido total para 10, se guarda residuo. Se resta 10 menos el residuo.
* El valor obtenido debe concordar con el digitoVerificador
*
* Nota: Cuando el residuo es cero(0) el d�gito verificador debe ser 0.
*
* @param string $digitosIniciales Nueve primeros d�gitos de CI/RUC
* @param string $digitoVerificador D�cimo d�gito de CI/RUC
*
* @return boolean
*
* @throws exception Cuando los digitosIniciales no concuerdan contra
* el c�digo verificador.
*/
    protected function algoritmoModulo10($digitosIniciales, $digitoVerificador)
    {
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);

        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);

        $total = 0;
        foreach ($digitosIniciales as $key => $value) {

            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );

            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }

            $total = $total + $valorPosicion;
        }

        $residuo = $total % 10;

        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }

        if ($resultado != $digitoVerificador) {
            throw new Exception('D�gitos iniciales no validan contra D�gito Idenficador');
        }

        return true;
    }

    /**
* Algoritmo Modulo11 para validar RUC de sociedades privadas y p�blicas
*
* El c�digo verificador es el decimo digito para RUC de empresas privadas
* y el noveno d�gito para RUC de empresas p�blicas
*
* Paso 1: Multiplicar cada d�gito de los digitosIniciales por su respectivo
* coeficiente.
*
* Para RUC privadas el coeficiente esta definido y se multiplica con las siguientes
* posiciones del RUC:
*
* Ejemplo
* digitosIniciales posicion 1 x 4
* digitosIniciales posicion 2 x 3
* digitosIniciales posicion 3 x 2
* digitosIniciales posicion 4 x 7
* digitosIniciales posicion 5 x 6
* digitosIniciales posicion 6 x 5
* digitosIniciales posicion 7 x 4
* digitosIniciales posicion 8 x 3
* digitosIniciales posicion 9 x 2
*
* Para RUC privadas el coeficiente esta definido y se multiplica con las siguientes
* posiciones del RUC:
*
* digitosIniciales posicion 1 x 3
* digitosIniciales posicion 2 x 2
* digitosIniciales posicion 3 x 7
* digitosIniciales posicion 4 x 6
* digitosIniciales posicion 5 x 5
* digitosIniciales posicion 6 x 4
* digitosIniciales posicion 7 x 3
* digitosIniciales posicion 8 x 2
*
* Paso 2: Se suman los resultados y se obtiene total
*
* Paso 3: Divido total para 11, se guarda residuo. Se resta 11 menos el residuo.
* El valor obtenido debe concordar con el digitoVerificador
*
* Nota: Cuando el residuo es cero(0) el d�gito verificador debe ser 0.
*
* @param string $digitosIniciales Nueve primeros d�gitos de RUC
* @param string $digitoVerificador D�cimo d�gito de RUC
* @param string $tipo Tipo de identificador
*
* @return boolean
*
* @throws exception Cuando los digitosIniciales no concuerdan contra
* el c�digo verificador.
*/
    protected function algoritmoModulo11($digitosIniciales, $digitoVerificador, $tipo)
    {
        switch ($tipo) {
            case 'ruc_privada':
                $arrayCoeficientes = array(4, 3, 2, 7, 6, 5, 4, 3, 2);
                break;
            case 'ruc_publica':
                $arrayCoeficientes = array(3, 2, 7, 6, 5, 4, 3, 2);
                break;
            default:
                throw new Exception('Tipo de Identificacion no existe.');
                break;
        }

        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);

        $total = 0;
        foreach ($digitosIniciales as $key => $value) {
            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
            $total = $total + $valorPosicion;
        }

        $residuo = $total % 11;

        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 11 - $residuo;
        }

        if ($resultado != $digitoVerificador) {
            throw new Exception('D�gitos iniciales no validan contra D�gito Idenficador');
        }

        return true;
    }

    /**
* Get error
*
* @return string Mensaje de error
*/
    public function getError()
    {
        return $this->error;
    }
    
    /**
* Set error
*
* @param string $newError
* @return object $this
*/
    public function setError($newError)
    {
        $this->error = $newError;
        return $this;
    }
}
?>