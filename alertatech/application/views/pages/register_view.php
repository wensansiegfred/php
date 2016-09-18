<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Alert A Tech</title>
    <link rel="stylesheet" href="<?php echo base_url()?>media/css/styles.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>media/jquery/themes/redmond/jquery.ui.all.css" />
<style type="text/css">
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
	ul li {
		display: inline;
	}

</style>
</head>
<body-->
<br>
<br>
<br>
<?php echo form_open('register'); ?>
<form>
<table border="1">
    <tr>
        <th align="right"><label for="email">Email Address:</label></th>
        <td><input class="text" id="email" type="text" name="email" value="<?php echo set_value('email'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="emailconf">Confirm Email Address:</label></th>
        <td><input class="text" id="emailconf" type="text" name="emailconf" value="<?php echo set_value('emailconf'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="password">Password:</label></th>
        <td><input class="text" id="password" type="password" name="password" value="<?php echo set_value('password'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="passconf">Confirm Password:</label></th>
        <td><input class="text" id="passconf" type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="company">Company:</label></th>
        <td><input class="text" id="company" type="text" name="company" value="<?php echo set_value('company'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="address">Address:</label></th>
        <td><input class="text" id="address" type="text" name="address" value="<?php echo set_value('address'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="city">City:</label></th>
        <td><input class="text" id="city" type="text" name="city" value="<?php echo set_value('city'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="state">State:</label></th>
        <td><input class="text" id="state" type="text" name="state" value="<?php echo set_value('state'); ?>" /></td>
    </tr>
    <tr>
        <th align="right"><label for="country">Country:</label></th>
        <td><input class="text" id="country" type="text" name="country" value="<?php echo set_value('country'); ?>" /></td>
    </tr>
</table>
<?php echo form_error('agree'); ?>
<div class="agree">
    <label for="agree" class="full"><input class="checkbox" id="agree" type="checkbox" name="agree" value="1" />I agree to the Alert A Tech Terms of Service</label>
</div>
<div><input type="submit" value="Submit" /></div>

<table>
    <tr>
        <td colspan="2">
            <?php echo validation_errors(); ?>
            <?php if($this->session->flashdata('message')) : ?>
                <p><?=$this->session->flashdata('message')?></p>
            <?php endif; ?>
        </td>
    </tr>
</table>
</form>
<!--/body>
</html-->