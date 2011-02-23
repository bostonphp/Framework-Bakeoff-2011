<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php __('Please Login'); ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end('Login'); ?>
