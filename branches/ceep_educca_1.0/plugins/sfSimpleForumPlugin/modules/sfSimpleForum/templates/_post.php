<?php use_helper('sfSimpleForum', 'Date') ?>
<tr>
  <!--td class="post_author" -->
  <?php
     $idusurio = $post->getUserId();
     $forum = sfSimpleForumForumPeer::retrieveByStrippedName($post->getsfSimpleForumForum()->getStrippedName());
     $cursoId = $forum->getCursoId();

        $c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "profesor");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

     $c2 = new Criteria();
     $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusurio);
     $c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
     $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $cursoId);
     $profesor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);


  ?>
  <?php if ($profesor)  : ?>
      <td class="post_author"   ><!--class="post_profesor"-->
   <?php else : ?>
      <td class="post_author">
   <?php endif;  ?>
    <?php  $usuario = UsuarioPeer::retrieveByPk($idusurio); ?>
    <? if ($usuario) : ?>
      <?php echo ($usuario->getFoto())? image_tag('fotos_usuarios/'.$usuario->getId()."_foto.jpg", 'Title=Foto, class=imgfotoperfil') : image_tag("fotos_usuarios/no_foto.jpg", "Title=Foto, class=imgfotoperfil"); ?>
      <br>
    <?endif; ?>

    <?php echo $post->getAuthorName()/*link_to($post->getAuthorName(), 'sfSimpleForum/latestUserPosts?username='.$post->getAuthorName()) */ ?><br/>
    <?php if (sfConfig::get('app_sfSimpleForumPlugin_show_author_details', false)): ?>
      <?php echo include_partial('sfSimpleForum/author', array('author_name' => $post->getAuthorName())) ?>
    <?php endif; ?>
    <?php echo $post->getCreatedAt("d-m-Y") ?>
  </td>
  <td class="post_message">
    <div class="post_details">
    <?php if ($include_thread): ?>
      <?php echo link_to($post->getsfSimpleForumForum()->getName(), 'sfSimpleForum/forum?forum_name='.$post->getsfSimpleForumForum()->getStrippedName()) ?>
     &raquo;
      <?php echo link_to($post->getParent()->getTitle(), 'sfSimpleForum/topic?id='.$post->getParent()->getId().'&stripped_title='.$post->getParent()->getStrippedTitle()) ?>
      &raquo;
    <?php endif; ?>
      <?php echo $post->getTitle() ?>
    </div>

            <div class="cont_mensaje">
                <?php echo $post->getContent() ?>
           </div>

    <ul class="post_actions">
      <?php /*if ($sf_user->hasCredential('moderator')): */?>
      <?php  if ( ($sf_user->esProfesorCurso($post->getsfSimpleForumForum()->getStrippedName())) || ($sf_user->hasCredential('supervisor'))) : ?>
        <li><?php echo link_to(__('Borrar'), 'sfSimpleForum/deletePost?id='.$post->getId(),array('id'=>'ln_borrar_post'.$post->getId())) ?></li>
      <?php endif; ?>
      <li>
	    <?php  if ( ($sf_user->esAlumnoCurso($post->getsfSimpleForumForum()->getStrippedName()))
		         || ($sf_user->esProfesorCurso($post->getsfSimpleForumForum()->getStrippedName()))
		         || ( sfSimpleForumForumPeer::retrieveByStrippedName($post->getsfSimpleForumForum()->getStrippedName())->getCursoId()==NULL) //foro general
				 ||($sf_user->hasCredential('supervisor'))) : ?>
	     <?php echo link_to(__('Contestar'), 'sfSimpleForum/postReply?id='.$post->getId()) ?></li>
	   <?php endif; ?>
    </ul>
  </td>
</tr>
<tr class="spacer"><td colspan="2"></td></tr>