<?php
/**
 * Functions to integrate outside services into exa.
 * 
 * This means setting up google analytics and chartbeat — as well as
 * facebook and twitter conversion tracking.
 *  
 * @package exa
 * @since v0.2
 */


/**
 * Outputs javascript code Chartbeat tracking in the footer.
 * 
 * Strings are assigned with HEREDOC format.
 * @see http://www.tuxradar.com/practicalphp/2/6/3
 * 
 * @since v0.2
 */
function exa_register_chartbeat() {		
	
	$chartbeatTitle = is_home() ? 'Homepage' : wp_title('',false);
 	
 	$js = "\n<script>\n";
	
	$js .= <<<"CHARTBEAT"

	/* Chartbeat */

	var _sf_async_config = {uid:45170,domain:'badgerherald.com',useCanonical:true};
		_sf_async_config.title ='$chartbeatTitle';
		(function(){
			function loadChartbeat() {
			window._sf_endpt=(new Date()).getTime();
			var e = document.createElement('script');
			e.setAttribute('language', 'javascript');
			e.setAttribute('type', 'text/javascript');
			e.setAttribute('src', '//static.chartbeat.com/js/chartbeat.js');
			document.body.appendChild(e);
		}
	var oldonload = window.onload;
	window.onload = (typeof window.onload != 'function') ?
	loadChartbeat : function() { oldonload(); loadChartbeat(); };
	})();


CHARTBEAT;

	$js .= "</script>\n\n";
	echo $js;

}
add_action('wp_footer','exa_register_chartbeat');

/**
 * Prints twitter conversion tracking ad code.
 *
 * This will let us track users who visit our site after being shown twitter ads.
 * Leveraged correctly, this will let us target website visitors and turn them
 * into return visitors.
 *
 * @since 0.2
 * 
 * @see https://support.twitter.com/articles/20170807-conversion-tracking-for-websites
 * @author Will Haynes
 */
function exa_twitter_conversion_tracker() {

	echo '<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
			<script type="text/javascript">
				twttr.conversion.trackPid(\'l4v5w\');
			</script>
			<noscript>
				<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l4v5w&p_id=Twitter" />
				<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4v5w&p_id=Twitter" />
			</noscript>';

}
add_action('wp_footer','exa_twitter_conversion_tracker');