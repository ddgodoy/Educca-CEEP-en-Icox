<?php use_helper('I18N') ?>
<?php /*$author = sfGuardUserPeer::retrieveByUsername($author_name) */?>
<?php $c2 = new Criteria();
  	  $c2->add(UsuarioPeer::NOMBREUSUARIO, $author_name);
	  $author = UsuarioPeer::doSelectOne($c2); ?>
<?php /*$author = UsuarioPeer::retrieveByPk($sf_user->getAnyId())*/ ?>
<?php $nb_posts = $author->countsfSimpleForumPosts() ?>
  <?php  /*echo __('Moderator')*/ ?><br/>
<?php /*endif*/ ?>
<?php if ($nb_posts>0) : ?>
	<?php echo format_number_choice('[1]1 mensaje|(1,+Inf] %1% mensajes', array('%1%' => $nb_posts), $nb_posts) ?><br />
<?php endif; ?>