<<<<<<< HEAD
<?php echo $translateFieldsFooter; ?>
</div>
<?php if ($all_fields_empty) { ?>
	<p><?php $clang->eT("Nothing to translate on this page");?></p><br />
<?php } ?>
<input type='hidden' name='<?php echo $type;?>_size' value='<?php echo $i ?>' />
<?php if ($associated) { ?>
	<input type='hidden' name='<?php echo $type2;?>_size' value='<?php echo $i;?>' />
<?php } ?>
</div>
=======
<?php echo $translateFieldsFooter; ?>
</div>
<?php if ($all_fields_empty) { ?>
	<p><?php $clang->eT("Nothing to translate on this page");?></p><br />
<?php } ?>
<input type='hidden' name='<?php echo $type;?>_size' value='<?php echo $i ?>' />
<?php if ($associated) { ?>
	<input type='hidden' name='<?php echo $type2;?>_size' value='<?php echo $i;?>' />
<?php } ?>
</div>
>>>>>>> refs/remotes/origin/master
