<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en-GB" prefix="og: http://ogp.me/ns#">

    <!--  -->
    <head itemscope itemtype="//schema.org/WebSite">
        <meta charset="UTF-8" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="xmlrpc.php" />
        <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,initial-scale=1.0" />
        <meta itemprop="name" content="Housing &amp"/>
        <meta itemprop="url" content="index.html"/>
        <title>Home - Housing - Swinburne University, Sarawak Malaysia</title>

        <!-- This site is optimized with the Yoast SEO plugin v5.3.3 - https://yoast.com/wordpress/plugins/seo/ -->
        <link rel="canonical" href="index.html" />
        <meta property="og:locale" content="en_GB" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Home - Housing &amp" />
        <meta property="og:description" content="Swinburne University of Technology Sarawak Campus is the international branch campus of Swinburne University of Technology, Melbourne, Australia. The Sarawak campus opened in Kuching, the capital city of the Malaysian state of Sarawak, in 2000." />
        <meta property="og:url" content="index.html" />
        <meta property="og:site_name" content="Housing &amp;" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:description" content="Swinburne University of Technology Sarawak Campus is the international branch campus of Swinburne University of Technology, Melbourne, Australia. The Sarawak campus opened in Kuching, the capital city of the Malaysian state of Sarawak, in 2000." />
        <meta name="twitter:title" content="Home - Housing &amp; Recreation - Swinburne University, Sarawak Malaysia" />

        <!-- / Yoast SEO plugin. -->

        <link rel='dns-prefetch' href='http://s.w.org/' />
        <link rel="alternate" type="application/rss+xml" title="Housing &amp; Recreation &raquo; Home Comments Feed" href="home/feed/index.html" />

        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 .07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
        </style>
        <link rel='stylesheet' id='rs-plugin-settings-css'  href='wp-content/plugins/revslider/rs-plugin/css/settings1dc6.css?ver=4.6.5' type='text/css' media='all' />
        <style id='rs-plugin-settings-inline-css' type='text/css'>
            .tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}.tp-caption a{color:#FF0000;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#FF0000}
        </style>
        <script type='text/javascript' src='wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4'></script>
        <script type='text/javascript' src='wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
        <script type='text/javascript' src='wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.tools.min1dc6.js?ver=4.6.5'></script>
        <script type='text/javascript' src='wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.revolution.min1dc6.js?ver=4.6.5'></script>

        <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                // CUSTOM AJAX CONTENT LOADING FUNCTION
                var ajaxRevslider = function(obj) {

                    // obj.type : Post Type
                    // obj.id : ID of Content to Load
                    // obj.aspectratio : The Aspect Ratio of the Container / Media
                    // obj.selector : The Container Selector where the Content of Ajax will be injected. It is done via the Essential Grid on Return of Content

                    var content = "";

                    data = {};

                    data.action = 'revslider_ajax_call_front';
                    data.client_action = 'get_slider_html';
                    data.token = 'd4e3981d58';
                    data.type = obj.type;
                    data.id = obj.id;
                    data.aspectratio = obj.aspectratio;

                    // SYNC AJAX REQUEST


                    // FIRST RETURN THE CONTENT WHEN IT IS LOADED !!
                    return content;						 
                };

                // CUSTOM AJAX FUNCTION TO REMOVE THE SLIDER
                var ajaxRemoveRevslider = function(obj) {
                    return jQuery(obj.selector+" .rev_slider").revkill();
                };

                // EXTEND THE AJAX CONTENT LOADING TYPES WITH TYPE AND FUNCTION
                var extendessential = setInterval(function() {
                    if (jQuery.fn.tpessential != undefined) {
                        clearInterval(extendessential);
                        if(typeof(jQuery.fn.tpessential.defaults) !== 'undefined') {
                            jQuery.fn.tpessential.defaults.ajaxTypes.push({type:"revslider",func:ajaxRevslider,killfunc:ajaxRemoveRevslider,openAnimationSpeed:0.3});   
                            // type:  Name of the Post to load via Ajax into the Essential Grid Ajax Container
                            // func: the Function Name which is Called once the Item with the Post Type has been clicked
                            // killfunc: function to kill in case the Ajax Window going to be removed (before Remove function !
                            // openAnimationSpeed: how quick the Ajax Content window should be animated (default is 0.3)
                        }
                    }
                },30);
            });
        </script>
        <meta name="robots" content="index,follow" />




        <link rel="shortcut icon" href="wp-content/uploads/2017/04/favicon.png">
        <link rel="apple-touch-icon" href="wp-content/uploads/2017/04/favicon.png">




        <link rel="alternate" type="application/rss+xml" title="Housing &amp; Recreation RSS Feed" href="feed/index.html" />
        <link rel="pingback" href="xmlrpc.php" />

        <link href="wp-content/themes/swinburne-sarawak-byhds/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/fonts/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/style.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/menus.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/responsive.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/flexslider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/slider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/login.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="wp-content/themes/swinburne-sarawak-byhds/isotope.css" media="screen" rel="stylesheet" type="text/css">
        <link href="wp-content/themes/swinburne-sarawak-byhds/magnific-popup.css" media="screen" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="wp-content/themes/swinburne-sarawak-byhds/colourtheme.css" type="text/css"  media="screen" type="text/css" />
</head>
<body>
	<div id="outer-header">
		<table cellspacing="0" cellpadding="0" border=0 style="border-spacing: 0px">
<tr>
<td>
<img src="https://allocate.swinburne.edu.my/aplus/jsp/common/swinburne-logo.gif" height="100" width="200">
</td>
<td bgcolor="#D8CDBA" height="100" width="100%">
<b><font color="white" size="6" face="VERDANA">
<pre>
   Swinburne Accommodaion 2017
</pre></font></b></td>
</tr>
</table>
	</div>
	<div class="container">
        <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">       
            <h2 class="form-signin-heading">Please login</h2>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <input type="text" class="form-control" name="username" placeholder="Student ID" required="" autofocus="" />
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <br/>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/> 
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
            </div>  
        </form>
    </div> 
    
    
    
    
    <script type="text/javascript" src="wp-content/themes/swinburne-sarawak-byhds/js/superfish.js"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/jquery.easing.1.3.js" type="text/javascript"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/jquery.flexslider.js" type="text/javascript"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/skrollr.js" type="text/javascript"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/jquery.magnific-popup.js" type="text/javascript"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/jquery-ui.js"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        <script src="wp-content/themes/swinburne-sarawak-byhds/js/script.js" type="text/javascript"></script>
        <script type='text/javascript' src='wp-includes/js/comment-reply.mina288.js?ver=4.8.1'></script>
        <script type='text/javascript' src='wp-includes/js/wp-embed.mina288.js?ver=4.8.1'></script>
	
</body>
</html>
