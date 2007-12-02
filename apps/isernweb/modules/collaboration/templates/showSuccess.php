<?php
// auto-generated by sfPropelCrud
// date: 2007/11/25 00:34:09
?>
<h1>View Collaboration</h1>
<table>
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $collaboration->getId() ?></td>
</tr>
<tr>
<th>Name: </th>
<td><?php echo $collaboration->getName() ?></td>
</tr>
<tr>
<th>Description: </th>
<td><?php echo $collaboration->getDescription() ?></td>
</tr>
</tbody>
</table>
<hr />

<?php echo link_to('edit', 'collaboration/edit?id='.$collaboration->getId()) ?>
&nbsp;<?php echo link_to('list', 'collaboration/list') ?>
<table><tr><td>
<h1>Collaborating Organizations:</h1>
<table class='list'>
<thead>
<tr>
  <th>Name</th>
</tr>
</thead>
<tbody>
<?php $collaboratingOrganizations = $collaboration->getCollaboratingOrganizations() ?>
<?php $i=1; 
  foreach ($collaboratingOrganizations as $co ): 
?>
<tr class='record <?php if (fmod(++$i, 2) ) : ?>even-record <?php endif;?>  '> 
      <td><?php  echo link_to($co->getOrganization()->getName(),'organization/show?id='.$co->getOrganizationId()) ?></td>
  </tr>
<?php  endforeach; ?>
</tbody>
</table>
</td><td>&nbsp;&nbsp;&nbsp;
</td><td>
<h1>Collaboration Years</h1>
<table class='list'>
<thead>
<tr>
  <th>Year</th>
</tr>
</thead>
<tbody>
<?php $collaborationYears = $collaboration->getCollaborationYears() ?>
<?php $i=1; 
  foreach ($collaborationYears as $cy ): 
?>
<tr class='record <?php if (fmod(++$i, 2) ) : ?>even-record <?php endif;?>  '> 
      <td><?php  echo $cy->getYear(); ?></td>
  </tr>
<?php  endforeach; ?>
</tbody>
</table>
</td>
</tr></table>