
/* <![CDATA[ */	
(function($) {
	function setCookie(name,value,days) {
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime()+(days*24*60*60*1000));
	        var expires = "; expires="+date.toGMTString();
	    }
	    else var expires = "";
	    document.cookie = name+"="+value+expires+"; path=/";
	}
 
	function getCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}
 
	$("#vote").not(".disabled").click(function() {
		var el = $(this);
		el.html('<span id="loader"></span>');
		var nonce = $("input#voting_nonce").val();
		var data = {
			action: 'add_votes_options',
			nonce: nonce,
			postid: '<?php echo $post->ID; ?>',
			ip: '<?php echo $_SERVER['REMOTE_ADDR']; ?>'			
		};
		$.post('<?php echo admin_url('admin-ajax.php'); ?>', data,
		function(response){
			if(response!="-1") {
				el.html("VOTED").unbind("click");
				if(response=="null") {
					alert("A vote has already been registered to this IP address.");
				} else {
					$("#votecounter").html(response);
					alert("Thanks for your vote.");
				}
				var cookie = getCookie("better_votes");
				if(!cookie) {
					var newcookie = "<?php echo $post->ID; ?>";
				} else {
					var newcookie = cookie + ",<?php echo $post->ID; ?>";
				}
				setCookie("better_votes", newcookie, 365);
			} else {
				alert("There was a problem registering your vote. Please try again later.");
			}
		});
		return false;
	});	
})(jQuery);
/* ]]> */
