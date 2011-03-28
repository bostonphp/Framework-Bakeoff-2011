<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('jobs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('jobs/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'jobs/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['location']->renderLabel() ?></th>
        <td>
          <?php echo $form['location']->renderError() ?>
          <?php echo $form['location'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['company']->renderLabel() ?></th>
        <td>
          <?php echo $form['company']->renderError() ?>
          <?php echo $form['company'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['category_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['category_id']->renderError() ?>
          <?php echo $form['category_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['keywords']->renderLabel() ?></th>
        <td>
          <?php echo $form['keywords']->renderError() ?>
          <?php echo $form['keywords'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['position']->renderLabel() ?></th>
        <td>
          <?php echo $form['position']->renderError() ?>
          <?php echo $form['position'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['token']->renderLabel() ?></th>
        <td>
          <?php echo $form['token']->renderError() ?>
          <?php echo $form['token'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_activated']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_activated']->renderError() ?>
          <?php echo $form['is_activated'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['agree_terms']->renderLabel() ?></th>
        <td>
          <?php echo $form['agree_terms']->renderError() ?>
          <?php echo $form['agree_terms'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['expires_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['expires_at']->renderError() ?>
          <?php echo $form['expires_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
