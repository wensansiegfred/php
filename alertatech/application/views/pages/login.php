<br/>
<br/>
<br/>
<?=form_open('login')?>

<form method="post" action="index.php?page=login&login=1" enctype="multipart/form-data" accept-charset="utf-8">
	<table border="1" id="login-table">
		<tr>
			<td>Member Login:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input type="text" id="name" class="name" name="name" value="<?php echo set_value('name'); ?>"/></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" id="password" class="password" name="password" value="<?php echo set_value('password'); ?>"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Submit" id="submit" class="submit"/></td>
		</tr>
		<tr>
			<td colspan="2">
                <?php echo validation_errors(); ?>
                <?php if(isset($this->session)) : ?>
                    <?php if($this->session->flashdata('message')) : ?>
                        <p><?=$this->session->flashdata('message')?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
		</tr>
	</table>
</form>