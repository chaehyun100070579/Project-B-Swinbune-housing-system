<?php if($_SESSION['id'])
{ ?>

<div class="brand clearfix">

    <div id="headerwrapper">
        <div id="header"  itemscope="itemscope" itemtype="//schema.org/WPHeader" > 
            <div class="container ">
                <div id="logo">
                    <a href="https://www.swinburne.edu.my/" rel="home">
                        <img src="../wp-content/uploads/Swinburne-Malaysia-Logo.png" alt="Swinburne University, Malaysia">
                    </a>


                </div>
                <!--/logo -->


                <ul class="topmenu">
                    <li><a href="https://www.swinburne.edu.my/category/library" target="_self">Library</a></li><li><a href="https://www.swinburne.edu.my/current-students" target="_self">Current Students</a></li><li><a href="https://www.swinburne.edu.my/contact" target="_self">Contact us</a></li><li><a href="https://blackboard.swinburne.edu.my/" target="_self">Blackboard Login</a></li><li></li>	        
                </ul>


                <span class="menu-btn"><i class="fa fa-bars"></i></span>
                <ul class="ts-profile-nav">
                    <li class="ts-account">
                        <a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
                        <ul>
                            <li><a href="my-profile.php">My Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>




            </div>

        </div><!--/container -->

    </div><!--/header -->



</div>


<?php
} else { ?>
<div class="brand clearfix">
    <div id="headerwrapper">
        <div id="header"  itemscope="itemscope" itemtype="//schema.org/WPHeader" > 
            <div class="container ">
                <div id="logo">
                    <a href="https://www.swinburne.edu.my/" rel="home">
                        <img src="../wp-content/uploads/Swinburne-Malaysia-Logo.png" alt="Swinburne University, Malaysia">
                    </a>


                </div>
                <!--/logo -->


                <ul class="topmenu">
                    <li><a href="https://www.swinburne.edu.my/category/library" target="_self">Library</a></li><li><a href="https://www.swinburne.edu.my/current-students" target="_self">Current Students</a></li><li><a href="https://www.swinburne.edu.my/contact" target="_self">Contact us</a></li><li><a href="https://blackboard.swinburne.edu.my/" target="_self">Blackboard Login</a></li><li></li>	        
                </ul>

                <script type="text/javascript">

                    jQuery(document).ready( function() {  
                        jQuery("#headersearchform .btnsearch").on('click', function(){	
                            var selectedaction = jQuery("#headersearchform .searchselect").find('option:selected').val();
                            switch (selectedaction) {
                                case "courses":
                                    jQuery("#headersearchform .wpsearchinput").val("");
                                    break;						

                            }	
                            jQuery("#headersearchform").submit();
                        }); 

                        jQuery("#headersearchform .searchselect").on('change',function() {
                            var action = jQuery(this).val();
                            switch (action) {
                                case "website":
                                    jQuery("#headersearchform").attr("action", "http://www.swinburne.edu.my/cse/");
                                    break;

                                case "staff":
                                    jQuery("#headersearchform").attr("action", "http://wwww.swinburne.edu.my/staff/");
                                    break;

                                case "courses":
                                    jQuery("#headersearchform").attr("action", "https://www.swinburne.edu.my/study/find-a-course");
                                    break;

                                default:
                                    jQuery("#headersearchformmobile").attr("action", "http://www.swinburne.edu.my/cse/");	
                            }				
                        });

                        jQuery('#headersearchform .searchinput').on('change', function(){
                            var qvar = jQuery(this).val();
                        });	 								


                    }); 
                </script>


                <div id="headerright">
                    <form method="get" id="headersearchform" action="https://www.swinburne.edu.my/" class="form-inline">
                        <div class="row row-1-padding">
                            <div class="col-sm-5">
                                <input type="text" value="" name="q" id="s" class="searchinput" placeholder="Insert keyword">
                            </div>
                            <div class="col-sm-5">
                                <select class="searchselect" name="select">
                                    <option value="website" selected="selected">Swinburne Web Site</option>
                                    <option value="staff">Swinburne Staff</option>		
                                    <option value="courses">Swinburne Courses</option>						
                                </select>        
                            </div>
                            <div class="col-sm-2">
                                <button class="btnsearch" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <input type="hidden" name="cx" value="017223850862384007352:izuqbw3slcy">
                            <input type="hidden" name="cof" value="FORID:10">
                            <input type="hidden" name="ie" value="UTF-8">       
                            <input type="hidden" class="wpsearchinput" name="s" value="">		       

                        </div>

                    </form>
                </div>


            </div>

        </div><!--/container -->

    </div><!--/header -->

</div>





<?php } ?>
