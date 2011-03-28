<h1>Jobs List</h1>

<form action="<?php echo url_for("jobs/index") ?>" method="get">
  <select name="category_id" id="job_category">
    <option value="">all</option>
    <?php foreach($categories as $category): ?>
    <option value="<?php echo $category->getId() ?>"><?php echo $category->getName() ?></option>   
    <?php endforeach ?> 
  </select>
  <input type="submit" value="go" />
</form>
  

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Location</th>
      <th>Company</th>
      <th>Email</th>
      <th>Category</th>
      <th>Title</th>
      <th>Position</th>
      <th>Description</th>
      <th>Token</th>
      <th>Is activated</th>
      <th>Agree terms</th>
      <th>Expires at</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Jobs as $Job): ?>
    <tr>
      <td><a href="<?php echo url_for('jobs/show?id='.$Job->getId()) ?>"><?php echo $Job->getId() ?></a></td>
      <td><?php echo $Job->getName() ?></td>
      <td><?php echo $Job->getLocation() ?></td>
      <td><?php echo $Job->getCompany() ?></td>
      <td><?php echo $Job->getEmail() ?></td>
      <td><?php echo $Job->getCategoryId() ?></td>
      <td><?php echo $Job->getTitle() ?></td>
      <td><?php echo $Job->getPosition() ?></td>
      <td><?php echo $Job->getDescription() ?></td>
      <td><?php echo $Job->getToken() ?></td>
      <td><?php echo $Job->getIsActivated() ?></td>
      <td><?php echo $Job->getAgreeTerms() ?></td>
      <td><?php echo $Job->getExpiresAt() ?></td>
      <td><?php echo $Job->getCreatedAt() ?></td>
      <td><?php echo $Job->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('jobs/new') ?>">New</a>
