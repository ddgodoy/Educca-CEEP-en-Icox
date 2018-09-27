 <table>
  <tr>
    <td>L</td>
    <td>M</td>
    <td>X</td>
    <td>J</td>
    <td>V</td>
    <td>S</td>
    <td>D</td>
  </tr>
<?php  foreach ($calendar as $week) : ?>
      <tr>
      <?php  foreach ($week as $day => $events) : ?>
         <?php   if (!empty($events)) : ?>
             <?php  foreach ($events as $event) : ?>
				           <p><td><?php  echo link_to_if(isset($event['url']), date('d', strtotime($day)) , $event['url']/*, array('alt' => $event['alt'])*/); ?></p></td>
			       <?php endforeach; ?>
		    <?php else : ?>
 			    <?php  echo ($day == date('Y-m-d')) ? '<td class="today"><b>' : '</b><td>';
                 echo '<div>' . date('d', strtotime($day)) . '</div>'; ?>
        <?php endif; ?>
       <?php endforeach; ?>
<?php endforeach; ?>
        </td>
    </tr>
</table>
