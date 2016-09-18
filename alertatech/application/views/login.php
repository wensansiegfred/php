<?php 
echo $doctype;
echo $header;
?>
<style type="text/css">
    #page-content {
    	width: 100%;
		margin-top: 50px;
		margin-bottom: 50px;
		padding: 2px;
		float: left;
		position: relative;
		min-height: 400px;
		padding: 5px;
		align:center;
	}	
	.bottomLinks {
		float: left;
		width: 100%;
	}
	#login-form {
		width: 500px;
}
	#login-form legend {
		font-weight:bold;	
	}
	#login-form fieldset {
		border: 1px solid #767676;
		background-color: #f3f3f3;
		
	}
	#login-table {
		width: 100%;
		padding: 1px;
		
	}
	#errormessage {
		color: #ff0000;
	}
</style>
</head>
<body>
<div id="page" class="page">
	<div id="forgotPassword" class="forgotPassword">
    	<a href="/forgot_password" class="password">Forgot your Password?</a>
        <div class="signUpLogin">
            <input type="button" id="signUp" class="signUp" value="Signup Now!" />
            <?php if(isset($usertoken) AND $usertoken != ""): ?>
                <input type="button" id="memberLogout" class="memberLogout" value="Logout" />
            <?php else: ?>
                <input type="button" id="memberLogin" class="memberLogin" value="Member Login" />
            <?php endif; ?>
            <input type="text" class="searchBox" value="Search Site" />
        </div>
    </div>
    <div id="headerLinks" class="headerLinks" align="right">
        <?php function is_selected($current, $page) { return ($current == $page) ? ' selected' : '' ; } ?>
        <ul class="headerMenu">
        <?php foreach ($menu as $p):?>
            <li class="headerLink<?php echo is_selected($p, $page)?>"><a href="<?php echo base_url() . $p ?>"><?php echo $p ?></a>
        <?php endforeach;?>
		</ul>
    </div>
    <a href="/"><div id="headerLogo" class="headerLogo"></div></a>
    <!-- Start of Body content -->
	<div id="page-content">
		<div id="login-form">
			<fieldset>
				<legend>Sign In to Alert A Tech</legend>
				<table id="login-table">
					<tr>
						<td colspan="2"><span id="errormessage"></span>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input style="height: 25px;" type="text" id="username" size="35"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input style="height: 25px;" type="password" id="password" size="35"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="button" value="Sign in" id="submitloginbtn"/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><a href="#">can't access your account?</a>
					</tr>
				</table>
			</fieldset>
		</div>
	</div>
	<br/>
    <hr />
    <div class="bottomLinks">
    	<div class="menu left">
            <?php echo anchor('/home', 'Home') ?> |
             <?php if(isset($usertoken) AND $usertoken != ""): ?>
                <?php echo anchor('/logout', 'Logout') ?> |
            <?php else: ?>
                <?php echo anchor('/login', 'Login') ?> |
            <?php endif; ?>
            <?php echo anchor('/about', 'About') ?> |
            <?php echo anchor('/support', 'Support') ?> |
            <?php echo anchor('/clients', 'Clients') ?> |
            <?php echo anchor('/contact', 'Contact') ?> 
        </div>
 <?php echo $footer;?>
