<?php
// auto-generated by sfPropelCrud
// date: 2007/11/24 12:45:00
?>
<h1>View Organization</h1>
<table>
<tbody>

<tr>
<th>Name: </th>
<td><?php echo $organization->getName() ?></td>
</tr>
<tr>
<th>Organization type: </th>
<td><?php echo $organization->getOrganizationType() ?></td>
</tr>
<tr>
<th>Country: </th>
<td><?php echo $organization->getCountry() ?></td>
</tr>
<tr>
<th>Home page: </th>
<td><?php echo $organization->getHomePage() ?></td>
</tr>
<tr>
<th>Research keywords: </th>
<td><?php echo $organization->getResearchKeywords() ?></td>
</tr>
<tr>
<th>Research description: </th>
<td><?php echo $organization->getResearchDescription() ?></td>
</tr>
<tr>
<th>Created at: </th>
<td><?php echo $organization->getCreatedAt() ?></td>
</tr>
</tbody>
</table>
<hr />
<div>
<?php echo link_to('edit', 'organization/edit?id='.$organization->getId()) ?>

&nbsp;<?php echo link_to('list organizations', 'organization/list') ?>
</div><br/>
<h1>Affiliated Researchers</h1>
<table class='list'>
<thead>
<tr>
  <th>Name</th>
</tr>
</thead>
<tbody>
<?php $researchers= $organization->getResearchers() ?>

<?php $i=1; 
  foreach ($researchers as $researcher ): 
?>
<tr class='record <?php if (fmod(++$i, 2) ) : ?>even-record <?php endif;?>  '> 
      <td><?php  echo link_to($researcher->getName(),'researcher/show?id='.$researcher->getId()) ?></td>
  </tr>
<?php  endforeach; ?>
</tbody>
</table>

