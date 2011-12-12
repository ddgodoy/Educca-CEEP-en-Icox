<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Ficha de evaluaci&oacute;n</title>
<?php echo include_http_metas() ?>
<?php echo include_metas() ?>


<?php echo use_helper('rollover') ?>

<link rel="shortcut icon" href="/favicon.ico" >
<link rel="icon" href="/icoanim.gif" type="image/gif" >

<link href="../../../web/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
       <div id="contenido">
	          <div id="wrapper">
	              <div id="col2">
	                  <?php echo $sf_data->getRaw('sf_content') ?>
	              </div> <!-- fin col2 -->
	          </div>
       </div>
</body>
</html>
