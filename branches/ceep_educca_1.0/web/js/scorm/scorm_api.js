// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DEL ENTORNO DE EJECUCIÓN SCORM 1.2       **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 24/10/2008                                     **
// **                                                              **
// ******************************************************************


// ******************************************************************
// **                                                              **
// **                    FUNCIONES AUXILIARES                      **
// **                                                              **
// ******************************************************************


//  Nombre de la función: performAjaxQuery (query, param)
//  Descripción:

function performAjaxQuery (query, param)
{
  var xmlHttp;
  var url = '/scorm/cmiQuery';
  
  try
  {
    // Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch (e)
  {
    // Internet Explorer 6.0+
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
      // Internet Explorer 5.5+
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e)
      {
        alert("Your browser does not support AJAX!");
        return false;
      }
    }
  }
  
  xmlHttp.open("POST", url+'?query='+query+'&param='+param, false);
  xmlHttp.send(null);

  return xmlHttp.responseText;
}
  


// ******************************************************************
// **                                                              **
// **             INICIALIZACIÓN DEL API SCORM                     **
// **                                                              **
// ******************************************************************

API = new Object();


// ******************************************************************
// **                                                              **
// **                          ESTADO API                          **
// **                                                              **
// ******************************************************************


//  Nombre de la variable: API.debug
//
//  Descripción: Cuando su valor es 'true' todas las funciones del API
//  se ponen en modo depuración y muestran mensajes alert indicando que
//  han sido llamadas y detalles de su comportamiento 

    API.debug = false;
    

//  Nombre de la variable: API.log
//
//  Descripción: Mantiene un registro de las llamadas realizadas al API,
//  detalles de su ejecución y valor devuelto.

    API.log = '';


//  Nombre de la variable: API.state
//
//  Descripción: Indica el estado en el que se encuentra el API.
//  0 - No inicializado  |  1 - Inicializado  |  2 - Terminado   
                
    API.state = 0;


//  Nombre de la variable: API.lasterror
//
//  Descripción: Indica el código numérico que representa el error que se 
//  produjo en la última llamada al API. 0 Es que no hay error, el resto
//  de códigos de error se pueden ver en las funciones LMSgetErrorString y
//  LMSgetDiagnostic
                
    API.lasterror = '0';



// ******************************************************************
// **                                                              **
// **                       MÉTODOS DEL API                        **
// **                                                              **
// ******************************************************************



//  Nombre del método: LMSInitialize (parameter)
//  Descripción:


    API.LMSInitialize = function(parameter) 
    {

      if (this.debug) {alert("LLAMADA LMSInitialize()"); API.log += 'LLAMADA: LMSInitialize ('+parameter+')\n';}
      
      if ((this.state == 0) || (this.state == 2)) 
      {
        this.state = 1;
        this.lasterror = '0';
        return 'true';
      }
      else
      {
        this.lasterror = '101';
        return 'false';
      }
    };



//  Nombre del método: LMSFinish (parameter)
//  Descripción:

    API.LMSFinish = function(parameter) 
    {
      if (this.debug) {alert("LLAMADA LMSFinish()"); API.log += 'LLAMADA: LMSFinish ('+parameter+')\n'; alert(API.log);}
      
      if (this.state == 1) 
      {
        this.state = 2;
        this.lasterror = '0';
        return 'true';
      }
      else
      {
        this.lasterror = '301';
        return 'false';
      }
    };



//  Nombre del método: LMSGetValue (descriptor, value)
//  Descripción:

    API.LMSGetValue = function(descriptor) 
    {
      if (this.debug) {alert('LLAMADA: LMSGetValue ('+descriptor+')');}
      if (this.debug) {API.log += 'LLAMADA: LMSGetValue ('+descriptor+') \n';}
      if (this.state == 1) 
      {
        var valor = performAjaxQuery('get.null.'+descriptor, 0);
        
        if (this.debug) {alert('Devolvio: '+valor);}
        
        if (valor.length > 0)
        {
          
          var returnvalue = valor.substring(2);
          if (valor.charAt(0) == 'e')
          {
            this.lasterror = returnvalue;
            return '';
          }
          if (valor.charAt(0) == 's')
          {
            this.lasterror = '0';
            return returnvalue;
          }
        }
        else
        {
          this.lasterror = '101';
          return '';
        }
        return valor;
      }
      else
      {
        this.lasterror = '301';
        return 'false';
      }
    };



//  Nombre del método: LMSSetValue (descriptor, value)
//  Descripción:

    API.LMSSetValue = function(descriptor, value) 
    {
      if (this.debug) {alert('LLAMADA: LMSSetValue ('+descriptor+', '+value+')');}
      if (this.debug) {API.log += 'LLAMADA: LMSSetValue ('+descriptor+', '+value+') \n';}
      if (this.state == 1) 
      {        
        var valor = performAjaxQuery('set.null.'+descriptor, value);

        if (this.debug) {alert('Devolvio: '+valor);}
        
        if (valor.length > 0)
        {
          if (valor.charAt(0) == 'e')
          {
            var returnvalue = valor.substring(2);
            this.lasterror = returnvalue;
            return 'false';
          }
          if (valor.charAt(0) == 's')
          {
            this.lasterror = '0';
            return 'true';
          }
        }
        else
        {
          this.lasterror = '101';
          return 'false';
        }
        return valor;
      }
      else
      {
        this.lasterror = '301';
        return 'false';
      }
    };



//  Nombre del método: LMSCommit (parameter)
//  Descripción:

    API.LMSCommit = function(parameter) 
    {
      if (this.debug) {API.log += 'LLAMADA: LMSCommit () \n';}
      if (this.state == 1) 
      {
        this.lasterror = '0';
        return 'true';
      }
      else
      {
        this.lasterror = '301';
        return 'false';
      }
    };



//  Nombre del método: LMSGetLastError ()
//  Descripción:

    API.LMSGetLastError = function() 
    {
      if (this.debug) {API.log += 'LLAMADA: LMSGetLastError ()...'+this.lasterror+'\n';}
      
      if (this.state != 0) 
      {
        return this.lasterror;
      }
      else
      {
        return '';
      }
    };



//  Nombre del método: LMSGetErrorString (errornumber)
//  Descripción:

    API.LMSGetErrorString = function(errornumber) 
    { 
      if (this.state != 0) 
      {
        switch (errornumber)
        {
          case '0': return 'No error'; break;
          case '101': return 'General Exception'; break;
          case '201': return 'Invalid argument error'; break;
          case '202': return 'Element cannot have children'; break;
          case '203': return 'Element not an array. Cannot have count.'; break;
          case '301': return 'Not initialized'; break;
          case '401': return 'Not implemented error'; break;
          case '402': return 'Invalid set value, element is a keyword'; break;
          case '403': return 'Element is read only'; break;
          case '404': return 'Element is write only'; break;
          case '405': return 'Incorrect Data Type'; break;
          default: return ''; break;
        }
      }
      else
      {
        this.lasterror = '301';
        return '';
      }
    };


//  Nombre del método: LMSGetDiagnostic (parameter)
//  Descripción:

    API.LMSGetDiagnostic = function(errornumber) 
    {
      if (this.state != 0) 
      {
        switch (errornumber)
        {
          case '0': return 'No error'; break;
          case '101': return 'General Exception'; break;
          case '201': return 'Invalid argument error'; break;
          case '202': return 'Element cannot have children'; break;
          case '203': return 'Element not an array. Cannot have count.'; break;
          case '301': return 'Not initialized'; break;
          case '401': return 'Not implemented error'; break;
          case '402': return 'Invalid set value, element is a keyword'; break;
          case '403': return 'Element is read only'; break;
          case '404': return 'Element is write only'; break;
          case '405': return 'Incorrect Data Type'; break;
          default: return ''; break;
        }
      }
      else
      {
        this.lasterror = '301';
        return '';
      }
    };


