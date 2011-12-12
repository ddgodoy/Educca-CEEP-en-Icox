<?php

// ******************************************************************
// **                                                              **
// **      IMPLEMENTACIÓN DE LA CLASE scormManifestHandler         **
// **      AUTOR:  ÁNGEL MARTÍN LATASA                             **
// **      VERSIÓN: 0.1  29/08/2008                                **
// **                                                              **
// ******************************************************************


// ##################################################################
// ##                                                              ##
// ##                      CONSTANTES GLOBALES                     ##
// ##                                                              ##
// ##################################################################

  define('SMH_WARNING', '50');
  define('SMH_ERROR_NO_MANIFEST_FILE', '101');
  define('SMH_ERROR_INVALID_XML', '201');
  define('SMH_ERROR_INVALID_SCHEMA', '301');
  define('SMH_ERROR_INVALID_SCHEMA_VERSION', '302');



















// ##################################################################
// ##################################################################
// ####                                                          ####
// ####                CLASE scorm12Handler                      ####
// ####                                                          ####
// ##################################################################
// ##################################################################



class scorm12Handler
{



// ******************************************************************
// **                                                              **
// **            ATRIBUTOS DE LA CLASE scorm12Handler              **
// **                                                              **
// ******************************************************************

  
  
  private $manifest_simple_xml;
  private $manifest_path;
  private $materia_id;
  private $scos_found;
  private $scos_warning;

  
  
// ******************************************************************
// **                                                              **
// **             MÉTODOS DE LA CLASE scorm12Handler               **
// **                                                              **
// ******************************************************************



  //  Nombre del método: __construct ()
  //
  //  Descripción: Constructor de la clase scorm12ManifestHandler

  public function __construct () 
  {
    $this->last_error = 0;
    $this->scos_found = 0;
    $this->skipped_scos = 0;
  }
  
  
  
  //  Nombre del método: initialize ($manifest_simple_xml, $materia_id)
  //
  //  Descripción: Le proporciona la ruta del manifiesto SCORM y un identificador
  //  de materia único para el LMS.
  //
  function initialize ($manifest_path, $manifest_simple_xml, $materia_id)
  {
    $this->manifest_simple_xml = $manifest_simple_xml;
    $this->manifest_path = $manifest_path;
    $this->materia_id = $materia_id;
  }
  
  
  
  //  Nombre del método: scorm12_recursive_item_processing ($item)
  //
  //  Descripción: Recorre el arbol de items del manifiesto de forma recursiva.
  //  Si el item que se está explorando es un nodo hoja y además corresponde a un
  //  SCO, se registra en la base de datos del LMS.
  //
  private function scorm12_recursive_item_processing ($item)
  {
    if ($item['identifierref'] != '')
    {
      $ref = (string) $item['identifierref'];
      $title = (string) $item->title;
      $sco12 = new Sco12();
      $sco12->setRefSco12($ref);
      $sco12->setIdMateria($this->materia_id);
      $sco12->setTitle($title);
      $file = '';
      foreach ($this->manifest_simple_xml->resources->resource as $resource)
      {
        $res = (string) $resource['identifier'];
        if ($resource['identifier'] == $ref)
        {
          $file = (string) $resource['href'];
          break;
        }
      }
      
      if ($file == '')
      {
        $this->skipped_scos++;
        return;
      }
      /*
      if (!file_exists($this->manifest_path.$file))
      {
        $this->skipped_scos++;
        return;
      }
      */
      $sco12->setFile($file);
      $this->scos_found++;
      $sco12->save();

      $this->last_error = 0;
      return;
    }
    else
    {
      foreach ($item->item as $next_item)
      {
        $this->scorm12_recursive_item_processing ($next_item);
      }
    }
  }
  
  
  
  //  Nombre del método: scorm12_load_scos ()
  //
  //  Descripción: Busca todos los SCO's del manifiesto y los carga en la base
  //  de datos del LMS
  //
  function scorm12_load_scos ()
  {
    $this->scos_found = 0;
    $this->skipped_scos = 0;
    $manifest = $this->manifest_simple_xml;
    foreach ($manifest->organizations->organization as $organization)
    {
      foreach ($organization->item as $item)
      {
        $this->scorm12_recursive_item_processing ($item);
      }
    }
    
    if ($this->skipped_scos > 0)
    {
      $this->last_error = SMH_WARNING;
    }
    else
    {
      $this->last_error = 0;
    }
    
    return $this->scos_found;
  }  
  
  
  
  //  Nombre del método: getLastError ()
  //
  //  Descripción: Le proporciona la ruta del manifiesto SCORM y un identificador
  //  de materia único para el LMS.
  //
  function getLastError ()
  {
    if (($this->last_error == 0) && ($this->skipped_scos > 0)) 
    {
       return SMH_WARNING;
    }
    else
    {
      return $this->last_error;
    }
  }


  //  Nombre del método: getLastErrorDetail ()
  //
  //  Descripción: Devuelve detalles sobre el último error
  //
  function getLastErrorDetail ()
  {
    if ($this->last_error == SMH_WARNING)
    {
      return 'Se procesaron '.$this->scos_found.' SCOs y se omitieron '.$this->skipped_scos;;
    }
  }

  
}




























// ##################################################################
// ##################################################################
// ####                                                          ####
// ####             CLASE scormManifestHandler                   ####
// ####                                                          ####
// ##################################################################
// ##################################################################


class scormManifestHandler
{


// ******************************************************************
// **                                                              **
// **         ATRIBUTOS DE LA CLASE scormManifestHandler           **
// **                                                              **
// ******************************************************************

  
  
  private $manifest_path;
  private $manifest_simple_xml;
  private $materia_id;
  private $last_error;
  private $error_detail;
  private $schema_type;
  private $schema_version;
  private $scos_found;
  private $schema_handler;
  



// ******************************************************************
// **                                                              **
// **          MÉTODOS DE LA CLASE scormManifestHandler            **
// **                                                              **
// ******************************************************************



  //  Nombre del método: __construct ()
  //
  //  Descripción: Constructor de la clase scorm12ManifestHandler

  public function __construct () 
  {
    $this->last_error = 0;
    $this->scos_found = 0;
  }



  //  Nombre del método: initialize ($manifest_path, $materia_id)
  //
  //  Descripción: Le proporciona la ruta del manifiesto SCORM y un identificador
  //  de materia único para el LMS.
  //
  function initialize ($manifest_path, $materia_id)
  {
    if (!file_exists($manifest_path.'imsmanifest.xml'))
    {
      $this->last_error = SMH_ERROR_NO_SCHEMA_FILE;
      return false;
    }
    
    $this->manifest_path = $manifest_path;
    if (!($this->manifest_simple_xml = simplexml_load_file($manifest_path.'imsmanifest.xml')))
    {
      $this->last_error = SMH_ERROR_INVALID_XML;
      return false;
    }
    $this->materia_id = $materia_id;
    
    //if ((file_exists($manifest_path.'adlcp_rootv1p2.xsd')) && (file_exists($manifest_path.'imscp_rootv1p1p2.xsd')) && (file_exists($manifest_path.'imsmd_rootv1p2p1.xsd')) && (file_exists($manifest_path.'ims_xml.xsd')))
    if (file_exists($manifest_path.'imsmanifest.xml'))
    {
      $this->schema_version = '1.2';
    }

    
    if ($this->schema_version != '1.2')
    {
      $this->last_error = SMH_ERROR_INVALID_SCHEMA_VERSION;
      return false;
    }
    
    $this->last_error = 0;
    return true;
  }
  
  
  
  //  Nombre del método: loadScos ()
  //
  //  Descripción: El handler hace las llamadas a los objetos pertinentes para
  //  que los SCO contenidos en el manifiesto se registren en el LMS
  //
  function loadScos ()
  {
    if ($this->schema_version == '1.2')
    {
      $this->schema_handler = new scorm12Handler();
      $this->schema_handler->initialize($this->manifest_path, $this->manifest_simple_xml, $this->materia_id);
      $nscos = $this->schema_handler->scorm12_load_scos();
      $error_code = $this->schema_handler->getLastError();
      
      if ($error_code == SMH_WARNING)
      {
        $this->last_error = SMH_WARNING;
        $this->error_detail = $this->schema_handler->getLastErrorDetail();
      }
      else
      {
        $this->last_error = 0;
      }
      
      return $nscos;
    }
  }



  //  Nombre del método: getLastError ()
  //
  //  Descripción: Le proporciona la ruta del manifiesto SCORM y un identificador
  //  de materia único para el LMS.
  //
  function getLastError ()
  {
    return $this->last_error; 
  }



  //  Nombre del método: getLastErrorDetail ()
  //
  //  Descripción: Devuelve detalles sobre el último error
  //
  function getLastErrorDetail ()
  {
    switch($this->last_error)
    {
      case 0: return 'No hubo errores';
      break;
    
      case SMH_ERROR_NO_MANIFEST_FILE: return 'No se encontró el fichero imsmanifest.xml';
      break;
    
      case SMH_ERROR_INVALID_XML: return 'El fichero imsmanifest.xml no es un fichero XML correcto';
      break;
      
      case SMH_ERROR_INVALID_SCHEMA: return 'Esquema de datos '.$this->schema_type.'no soportado';
      break;
      
      case SMH_ERROR_INVALID_SCHEMA_VERSION: return 'Versión de SCORM '.$this->schema_version.' no soportada';
      break;
      
      case SMH_WARNING: return $this->error_detail.'... Los SCOs omitidos contenian algun error';
      break;
      
    } 
  }
  
  
  
  //  Nombre del método: getScormVersion ()
  //
  //  Descripción: Devuelve detalles sobre el último error
  //
  function getScormVersion ()
  {
    return $this->schema_version;
  }
}




?>
