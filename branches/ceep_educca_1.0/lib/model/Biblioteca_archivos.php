<?php

/**
 * Subclass for representing a row from the 'biblioteca_archivos' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Biblioteca_archivos extends BaseBiblioteca_archivos
{
  
 public function getNombreFichero()
 {
    $pos = strpos($this->nombre, '-');
    if ($pos) {$pos++;}
    return substr($this->nombre, $pos);
 }
 
 
  public function pathDirectory()
 {
   $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
   $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$this->getIdCurso();
   
   return $carpeta;
 }
 
 public function pathFile()
 {
   $file = $this->pathDirectory().DIRECTORY_SEPARATOR.$this->getNombre();
   
   return $file;
 }
 
 /**
 *
 * @name         saveForm($params)
 * @access       public
 * @author       Jacobo Chaquet
 * @description  guarda en la BD la informacion del fichero de la biblioteca de archivos
 */
  
  public static function saveForm($params, $fichero, $id_ba=null)
  {
    $params = $params->getAll();
    
    if (null==$id_ba)
    {$ba = new Biblioteca_archivos();
     $ba->setIdCurso($params['idcurso']);}
    else { $ba = Biblioteca_archivosPeer::RetrieveByPk($id_ba);}
    
    if (!$ba) {return null;}
    
    $ba->setDescripcion($params['descripcion']);
    
    $ba->save();
    
    //echo print_r($fichero);
    if($fichero)
    {
       if (is_readable($_FILES['fichero']['tmp_name']))
       {
         $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
         $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$ba->getIdCurso();
         
         if ($ba->getNombre())
         {
           $file = $carpeta.DIRECTORY_SEPARATOR.$ba->getNombre();
           if (file_exists($file))
           {  unlink($file); }
         }
         
         $nombre_fichero= $ba->getId().'-'.$_FILES['fichero']['name'];
         $ba->setNombre($nombre_fichero);
         $ba->save();
         
         $file = $carpeta.DIRECTORY_SEPARATOR.$nombre_fichero;
         
         if (!file_exists($dir_raiz))
         {  mkdir($dir_raiz,0777,true);}
         
         if (!file_exists($carpeta))
         {  mkdir($carpeta,0777,true);}
         
         if (file_exists($file))
         {  unlink($file); }
         copy($_FILES['fichero']['tmp_name'] , $file );
         chmod($file, 0777);
       }
    }
    
    return $ba;
  }
  
  public function customDelete()
  {
    $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
    $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$this->getIdCurso();
    $file = $carpeta.DIRECTORY_SEPARATOR.$this->getNombre();
    if (file_exists($file))
    {  unlink($file); }
    $this->delete();
  }
  
  public function permiso($modo,$usuario)
  {
     switch ($modo)
     {
       case 'eliminar':  if ($usuario->esProfesor($this->getIdCurso()))
                         { return true; }
                         break;
       case 'modificar': if ($usuario->esProfesor($this->getIdCurso()))
                         {return true;}
                         break;
       case 'download' : if ( ($usuario->esProfesor($this->getIdCurso())  || $usuario->esAlumno($this->getIdCurso())))
                         {return true;} 
                         break;                   
     }
     
     return false;
  }
  
  public function linkDonwnload($text_file=true,$usuario=null,$ok='download2.png',$stop='stop.png',$warning='warning.png')
  {

     if (null==$usuario)
     { $usuario = UsuarioPeer::retrieveByPk(sfContext::getInstance()->getUser()->getAnyId()); }
     
     if (!$this->permiso('download',$usuario))
     {  return '<img id="ico_download_stop'.$this->getId().'" src="/images/'.$stop.'" title="No tiene permisos para descargar el fichero" >';}
     else {
            $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
            $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$this->getIdCurso();
            $file = $carpeta.DIRECTORY_SEPARATOR.$this->getNombre();
            if (!file_exists($file))
            {  return '<img id="ico_download_warning'.$this->getId().'" src="/images/'.$warning.'" title="El fichero no se ecuentra en el servidor" >'; }
            else {
                   //$link="<a id='link_download_biblioteca_archivos".$this->getId()."' href='/biblioteca_archivos/".$this->getIdCurso()."/".$this->getNombre()."' >";  
                   $link="<a id='link_download_biblioteca_archivos".$this->getId()."' href='/biblioteca_archivos/download?id=".$this->getId()."' >";
                   $link.='<img id="ico_download_ok'.$this->getId().'" src="/images/'.$ok.'" title="Descargar el fichero'.$this->getNombre().'" border="0"> ';
                   if($text_file) {$link.=$this->getNombre();};
                   $link.='</a>';
                   
                   return $link; 
                 }
          }
  }
  
  public function overlib($width=400)
  {
    
    $descripcion = str_replace("\r\n","<br>",nl2br($this->getDescripcion()));
    $descripcion = str_replace("\"","&quot;",$descripcion);
    $descripcion = str_replace('\'',"\\'",$descripcion);
    
    $cad ="onmouseover=\"overlib('<table class=\'toverlib\' style=\'width:".$width."px\' >";
    $cad .=                       "<tr  class=\'tr2\'>";
    $cad .=                         "<td>Fichero: ".$this->getNombreFichero()."</td>";
    $cad .=                       "</tr>";
    $cad .=                       "<tr class=\'tr3\'>";
    $cad .=                         "<td>".$descripcion."</td></tr></table>'";
    $cad .=                       ", CAPTION,'".$this->getCurso()->getNombre()."',";
    $cad .=                       "FGCOLOR, '#FFFFFF', ";
    $cad .=                       "BGCOLOR, '#CCCCCC', ";
    $cad .=                       "BORDER, '2')\"";
    $cad .= "onmouseout=\"nd()\"";
     return $cad;       
  }
  
  public function getFileExtension()
  {
    $pos=-1;
    $cad=$this->nombre;

    while (0!=$pos)
    {
       $pos = strpos($cad, '.');
       if ($pos) {$pos++;}
       $cad = substr($cad, $pos);  
    }
    return strtolower($cad);
  }
  
  public function getIcoTipo()
  {
    switch ($this->getFileExtension())
    {
       case 'zip' : $tipo= 'zip.png';break;
       case 'rar' : $tipo= 'zip.png';break;
       case 'pdf' : $tipo= 'pdf.png';break;
       case 'doc' : $tipo= 'doc.png';break;
       case 'docx': $tipo= 'doc.png';break;
       case 'txt' : $tipo= 'txt.png';break;
       case 'jpg' : $tipo= 'jpg.png';break;
       case 'gif' : $tipo= 'gif.png';break;
       case 'exe' : $tipo= 'exe.png';break;
       case 'xls' : $tipo= 'excel.png';break;
       case 'xlsx' : $tipo= 'excel.png';break;
       default:  $tipo='unknown.png';
    }
    
    return '<img src="/images/ficheros/'.$tipo.'" border="0">'; 
  }
  
  public function getFileSize()
  {
     if (file_exists($this->pathFile()))
     {  
        $size=(int)(filesize($this->pathFile()) / 1000);
        if (0==$size)
        { return 1;}
        else return  $size ;
      };
  }
}
