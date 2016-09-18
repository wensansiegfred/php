<?php 
echo $doctype;
echo $header;
?>
 <script>
    $(document).ready(function(){
    	$("#signUp").click(function(){
    		window.location.href = '/signup';
    	});
        $("#memberLogin").click(function(){
    		window.location.href = '/home/login';
    	});
        $("#memberLogout").click(function(){
    		window.location.href = '/home/logout';
    	});
    	$("#freeplanbtn").click(function(){
        	var data = "/signup/freesignup"
    		$.ajax({
    			url: data,  
    			type: "POST", 
    			cache: false,
    			success: function (html) {
    				$('#page-content').html(html);
    				$('#page-content').fadeIn('slow');       
    			},
    			error: function (html) {
    				$('#page-content').html(html);
    				$('#page-content').fadeIn('slow');
    			}       
    		});	
        });
    });
    </script>
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
	}
	#free-signup {
		width: 45%;
		border: 1px solid #ddd;
		height: 100%;
		float: left;
		min-height: 250px;
	}
	#paid-signup {
		width: 45%;
		border: 1px solid #ddd;
		height: 100%;
		float: right;
		min-height: 250px;
	}
	.bottomLinks {
		float: left;
		width: 100%;
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
		<div id="free-signup">
			Free Plan
			<br/>
			<input type="button" id="freeplanbtn" value="Sign Up"/>
		</div>
		<div id="paid-signup">
			Paid Plan
			<br/>
			<input type="button" id="paidplanbtn" value="Sign Up"/>
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
        <div class="right copyright">
        	Copyright 2010 by Alert A Tech Services &bull; All Rights Reserved
        </div>
    </div>
	<div style="height:30px;"></div>
</div>
</body>
</html>
