<link rel="stylesheet" type="text/css" href="<?php echo "media/css/styles.css"?>" />
<body>
<?php echo form_open('register'); ?>
<?php echo validation_errors(); ?>

<table>
    <tr>
        <th align="right"><label for="email" class="required">Email Address:</label></th>
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
    <label for="agree" class="full"><input class="checkbox" id="agree" type="checkbox" name="agree" value="1"/>I agree to the Alert A Tech Terms of Service</label>
</div>
<div><input type="submit" value="Submit" /></div>
</body>