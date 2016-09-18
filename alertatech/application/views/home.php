<?php 
echo $doctype;
echo $header;
?>
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
	<?php include("pages/".$page.".php"); ?>
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