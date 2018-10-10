<?php
// auto-generated by sfViewConfigHandler
// date: 2018/09/20 23:09:22
$context  = $this->getContext();
$response = $context->getResponse();

if ($this->actionName.$this->viewName == 'verFicheroSuccess')
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else if ($this->actionName.$this->viewName == 'chatlayout')
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = $response->getParameter($this->moduleName.'_'.$this->actionName.'_template', $this->actionName, 'symfony/action/view');
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'verFicheroSuccess')
{
  if (!$context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('layout'.$this->getExtension());
  }
  $this->setComponentSlot('menu', 'menu', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu" (menu/supervisor)');
  $this->setComponentSlot('menu_top', 'menu_top', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu_top" (menu_top/supervisor)');
  $this->setComponentSlot('submenu', 'submenu', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "submenu" (submenu/default)');
  $this->setComponentSlot('calendario', 'calendario', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "calendario" (calendario/default)');
  $this->setComponentSlot('aviso', 'aviso', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "aviso" (aviso/default)');
  $this->setComponentSlot('login', 'login', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "login" (login/default)');
  $response->addHttpMeta('content-type', 'text/html; charset=utf-8', false);
  $response->addMeta('title', 'Plataforma Ceep', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', 'plataforma de formacion online Plataforma Ceep', false, false);
  $response->addMeta('keywords', 'e-learning, plataforma', false, false);
  $response->addMeta('language', 'es', false, false);

  $response->addJavascript('events');
}
else if ($templateName.$this->viewName == 'chatlayout')
{
  if (!$context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('layout'.$this->getExtension());
  }
  $this->setComponentSlot('menu', 'menu', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu" (menu/supervisor)');
  $this->setComponentSlot('menu_top', 'menu_top', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu_top" (menu_top/supervisor)');
  $this->setComponentSlot('submenu', 'submenu', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "submenu" (submenu/default)');
  $this->setComponentSlot('calendario', 'calendario', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "calendario" (calendario/default)');
  $this->setComponentSlot('aviso', 'aviso', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "aviso" (aviso/default)');
  $this->setComponentSlot('login', 'login', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "login" (login/default)');
  $response->addHttpMeta('content-type', 'text/html; charset=utf-8', false);
  $response->addMeta('title', 'Plataforma Ceep', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', 'plataforma de formacion online Plataforma Ceep', false, false);
  $response->addMeta('keywords', 'e-learning, plataforma', false, false);
  $response->addMeta('language', 'es', false, false);

  $response->addStylesheet('main', '', array ());
  $response->addJavascript('events');
}
else
{
  if (!$context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('layout'.$this->getExtension());
  }
  $this->setComponentSlot('menu', 'menu', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu" (menu/supervisor)');
  $this->setComponentSlot('menu_top', 'menu_top', 'supervisor');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "menu_top" (menu_top/supervisor)');
  $this->setComponentSlot('submenu', 'submenu', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "submenu" (submenu/default)');
  $this->setComponentSlot('calendario', 'calendario', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "calendario" (calendario/default)');
  $this->setComponentSlot('aviso', 'aviso', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "aviso" (aviso/default)');
  $this->setComponentSlot('login', 'login', 'default');
  if (sfConfig::get('sf_logging_enabled')) $context->getLogger()->info('{sfViewConfig} set component "login" (login/default)');
  $response->addHttpMeta('content-type', 'text/html; charset=utf-8', false);
  $response->addMeta('title', 'Plataforma Ceep', false, false);
  $response->addMeta('robots', 'index, follow', false, false);
  $response->addMeta('description', 'plataforma de formacion online Plataforma Ceep', false, false);
  $response->addMeta('keywords', 'e-learning, plataforma', false, false);
  $response->addMeta('language', 'es', false, false);

  $response->addStylesheet('main', '', array ());
  $response->addJavascript('events');
}

