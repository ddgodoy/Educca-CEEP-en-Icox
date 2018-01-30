<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Contenido del curso</title>
  <?php echo include_http_metas() ?>
  <?php echo include_metas() ?>
  <link rel="shortcut icon" href="/favicon.ico" >
  <link rel="icon" href="/icoanim.gif" type="image/gif" >
  <script language="javascript" type="text/javascript" src="/js/scorm/scorm_api.js"></script>

</head>
<body>

  <?php echo $sf_data->getRaw('sf_content') ?>

</body>
</html>
