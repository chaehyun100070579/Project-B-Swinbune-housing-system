var showPostDetailsWindow = false;

	
	function loadPostByID(id) {
		jQuery('.contentloading').fadeIn();
		jQuery('.contentInner').html('');		
		jQuery.ajaxSetup({cache:false}); 
		jQuery('.contentInner').load("ajaxpost/index.html",{id:id}, function() {
				 jQuery('.contentloading').fadeOut();
		});
		
		if (!showPostDetailsWindow) {
			togglePostDetailsWindow();	
		}
			
		return false;			
	} 
	

	function togglePostDetailsWindow(action) {
		if (action == "close") {
			showPostDetailsWindow = false;		
		} else {			     	
			showPostDetailsWindow = true;			
		}
	     	var options = {};
		 	jQuery('#ajaxloadpost').toggle( "fade", options, 500 );		
	}	
	

jQuery(document).ready( function() {  
	jQuery('ul.sf-menu').superfish({
			delay       : 0,
            speed:         'fast',
			disableHI:   true,            
	});
	
	jQuery('ul#more-nav').superfish({
			delay       : 0,
            speed:         'fast',
			disableHI:   true,            
	});
	
	jQuery('ul.sf-menu li').mouseover(function() {
		if (jQuery("a", this).hasClass('sf-with-ul')){ 
			jQuery(".js-navi-overlay").addClass("is-active")
		};
	}).mouseout(function() {
    	jQuery(".js-navi-overlay").removeClass("is-active")
	});
	
	jQuery("#back-top").hide();
	

	// scroll body to 0px on click
	jQuery('#back-top a').click(function () {
		jQuery('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 100) {
			jQuery('#back-top').fadeIn();
			jQuery('#headerwrapper').addClass("sticky");			
		} else {
			jQuery('#back-top').fadeOut();
		    jQuery('#headerwrapper').removeClass("sticky");
			
		}
	});
	
    jQuery('#accordion').on('shown.bs.collapse', function (e) {
        var offset = jQuery(this).find('.collapse.in').prev('.panel-heading');
        if(offset) {
            jQuery('html,body').animate({
                scrollTop: jQuery(offset).offset().top -20
            }, 500); 
        }
    }); 		
					   
	
	 jQuery('.scrollto a').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = jQuery(this.hash);
	      var stickyH = jQuery('#header').outerHeight()+10;
	      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        jQuery('html,body').animate({
	          scrollTop: target.offset().top - stickyH 
	        }, 1200);
	        jQuery('.navbar-collapse.in').collapse('hide');	        
	        return false;
	      }
	    }
	  });	
	  
	var hash = window.location.hash;
	if(hash){	
		var target = jQuery(hash);
		var stickyH = jQuery('#header').outerHeight();
		target = target.length ? target : jQuery('[name=' + hash.slice(1) +']');
		jQuery('html, body').animate({ 
	          scrollTop: target.offset().top - stickyH 
		}, 1000);

	}  	
	
	jQuery(".entry table").addClass("table table-bordered");
	jQuery(".table").wrap("<div class='table-responsive'></div>");

		
	jQuery(".gform_wrapper .disable input").attr('disabled','disabled');
	
	//jQuery('[data-toggle="tooltip"]').tooltip();
	//jQuery('[data-toggle="popover"]').popover();
	
	jQuery('.callimagepop').each(function() {
	     jQuery(this).magnificPopup({ 
	        type:'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
            	verticalFit: true
			},
			zoom: {
           	 enabled: true,
		   	 duration: 300 // don't foget to change the duration also in CSS
		   	}			        
	    });
	});
	
	jQuery('.gallery').each(function() {
	     jQuery(this).magnificPopup({ 
	        delegate: 'a',
	        type:'image', 
	        gallery: {
	            enabled: true
	        },
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
	        	verticalFit: true
			},
			zoom: {
	       	 enabled: true,
		   	 duration: 300 // don't foget to change the duration also in CSS
		   	}			        
	    });
	});	


	  
	var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};	 
		

	  function skrollrInit() {
		    skrollr.init({ 
				smoothScrolling:true,
			    render: function(data) {
				}            
		    });
	  }
 

	  if (isMobile.any()) {
	    
	  } else {
		 skrollrInit(); 
	  }
	  

	  

	  jQuery(window).on('resize', function (e) {
		  if (isMobile.any()) {
		    
		  } else {
			 skrollrInit(); 
		  }
		  
	    
        var parentWidth = jQuery(".sf-menu").parent().width() - 30;
        var ulWidth = jQuery("#more-nav").outerWidth();                  
        var menuLi = jQuery(".sf-menu > li");                 
        var liForMoving = new Array();      
        //take all elements that can't fit parent width to array
        menuLi.each(function () {                       
            ulWidth += jQuery(this).outerWidth(); 
            if (ulWidth > parentWidth) {
                //console.log(ulWidth);
                liForMoving.push(jQuery(this));
            }
        });                         
        if (liForMoving.length > 0) {   //if have any in array -> move them to "more" ul
            e.preventDefault();                     
            liForMoving.forEach(function (item) {
                item.clone().appendTo(".subfilter");
                item.remove();
            });                         
        }
        else if (ulWidth < parentWidth) { //check if we can put some 'li' back to menu
            liForMoving = new Array();
            var moved = jQuery(".subfilter > li");
            for (var i = moved.length - 1; i >= 0; i--) { //reverse order
                var tmpLi = jQuery(moved[i]).clone();
                tmpLi.appendTo(jQuery(".sf-menu"));
                ulWidth += jQuery(moved[i]).outerWidth();
                if (ulWidth < parentWidth) {                                
                    jQuery(moved[i]).remove();
                }
                else {
                    ulWidth -= jQuery(moved[i]).outerWidth();
                    tmpLi.remove();
                }                           
            }                       
        }                       
        if (jQuery(".subfilter > li").length > 0) { //if we have elements in extended menu - show it
            jQuery("#more-nav").show();
        }
        else {
            jQuery("#more-nav").hide();
        }	    
	  });	

	jQuery("body").tooltip({ selector: '[data-toggle=tooltip]' });	  
	
	jQuery('.buttonclose').click(function () {			
		togglePostDetailsWindow("close");
		return false;
	});		

    
    jQuery('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault(); 
        event.stopPropagation(); 
        jQuery(this).parent().siblings().removeClass('open');
        jQuery(this).parent().toggleClass('open');
    });		
    

	

    jQuery(window).trigger("resize"); //call resize handler to build menu right

				
}); //end documentready
