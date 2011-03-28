<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Job->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $Job->getName() ?></td>
    </tr>
    <tr>
      <th>Location:</th>
      <td><?php echo $Job->getLocation() ?></td>
    </tr>
    <tr>
      <th>Company:</th>
      <td><?php echo $Job->getCompany() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $Job->getEmail() ?></td>
    </tr>
    <tr>
      <th>Category:</th>
      <td><?php echo $Job->getCategoryId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $Job->getTitle() ?></td>
    </tr>
    <tr>
      <th>Keywords:</th>
      <td>
        <?php foreach($Job->getSplitKeywords() as $word): ?>
          <?php echo link_to($word, "jobs/index?tag=".$word) ?>
        <?php endforeach ?>
      </td>
    </tr>      
    <tr>
      <th>Position:</th>
      <td><?php echo $Job->getPosition() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $Job->getDescription() ?></td>
    </tr>
    <tr>
      <th>Token:</th>
      <td><?php echo $Job->getToken() ?></td>
    </tr>
    <tr>
      <th>Is activated:</th>
      <td><?php echo $Job->getIsActivated() ?></td>
    </tr>
    <tr>
      <th>Agree terms:</th>
      <td><?php echo $Job->getAgreeTerms() ?></td>
    </tr>
    <tr>
      <th>Expires at:</th>
      <td><?php echo $Job->getExpiresAt() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Job->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Job->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="mailto:<?php echo $Job->getApplyEmail() ?>">Apply</a>
&nbsp;
<a href="<?php echo url_for('jobs/edit?id='.$Job->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('jobs/index') ?>">List</a>
