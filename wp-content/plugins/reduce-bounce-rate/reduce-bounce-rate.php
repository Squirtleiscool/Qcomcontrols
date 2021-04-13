<?php
/*
Plugin Name: Reduce Bounce Rate
Plugin URI: http://wordpress.org/extend/plugins/reduce-bounce-rate/
Description: Get the real Bounce Rate and pageviews into Google Analytics.
Author: Okoth1
Version: 4.3.1
License: GPLv3

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/.
*/

function rbr_load_scripts($hook) {
    global $rbr_settings_page;
    if ($hook != $rbr_settings_page)
        return;
    wp_enqueue_style('rbr-style', plugins_url('reduce-bounce-rate/css/rbr-style.css', dirname(__FILE__)));
    wp_enqueue_script('rbr-jquery', plugins_url('reduce-bounce-rate/js/rbr-jquery.js', dirname(__FILE__)));
}
add_action('admin_enqueue_scripts', 'rbr_load_scripts');

$rbr_defaults = array(
    'rbr_pause' => 'pauseno',
    'rbr_disableadmin' => 'disableadminno',
    'rbr_type' => 'analyticsjs',
    'rbr_place' => 'footer',
    'rbr_scroll' => 'scrollno',
    'rbr_scrollpercentage' => 'scrollpercentageno',
    'rbr_scrollpercentagenumber' => 25,
    'rbr_event' => 10,
    'rbr_noevent' => '',
    'rbr_nomaxtime' => '',
    'rbr_time' => 900
);

function rbr_init() {
    global $rbr_defaults;
    foreach ($rbr_defaults as $optName => $optDefault) {
        if (!get_option($optName)) {
            update_option($optName, $optDefault);
        }
    }
}
add_action("init", "rbr_init");

function rbr_options() {
?>

<h1>Reduce Bounce Rate Options</h1>
<hr />
<?php
    if (isset($_POST['rbr_show']) == 'go') {
        $rbrpause = $_POST['rbr_pause'];
        update_option('rbr_pause', $rbrpause);
        
        $rbrdisableadmin = $_POST['rbr_disableadmin'];
        update_option('rbr_disableadmin', $rbrdisableadmin);
        
        $rbrtype = $_POST['rbr_type'];
        update_option('rbr_type', $rbrtype);
        
        $rbrplace = $_POST['rbr_place'];
        update_option('rbr_place', $rbrplace);
        
        $rbrscroll = $_POST['rbr_scroll'];
        update_option('rbr_scroll', $rbrscroll);
        
        $rbrscrollpercentage = $_POST['rbr_scrollpercentage'];
        update_option('rbr_scrollpercentage', $rbrscrollpercentage);
        
        $rbrscrollpercentagenumber = $_POST['rbr_scrollpercentagenumber'];
        update_option('rbr_scrollpercentagenumber', $rbrscrollpercentagenumber);
        
        $rbrnoevent = $_POST['rbr_noevent'];
        update_option('rbr_noevent', $rbrnoevent);
        
        $rbrnomaxtime = $_POST['rbr_nomaxtime'];
        update_option('rbr_nomaxtime', $rbrnomaxtime);
        
        $rbrevent = $_POST['rbr_event'];
        //clean the input, only integer numbers are allowed here
        preg_match_all('/(\d+)(\D|\b|$)/smUi', $rbrevent, $m, PREG_PATTERN_ORDER);
        if (count($m[0]) > 0) {
            $rbrevent = (int) $m[1][0];
        } else {
            $rbrevent = 0;
        }
        //clean the input, only integer numbers are allowed here
        update_option('rbr_event', $rbrevent);
        
        $rbrtime = $_POST['rbr_time'];
        //clean the input, only integer numbers are allowed here
        preg_match_all('/(\d+)(\D|\b|$)/smUi', $rbrtime, $m, PREG_PATTERN_ORDER);
        if (count($m[0]) > 0) {
            $rbrtime = (int) $m[1][0];
        } else {
            $rbrtime = 0;
        }
        //clean the input, only integer numbers are allowed here
        update_option('rbr_time', $rbrtime);
?>
<div class="notif"><p><?php
        _e('<span class="bigbold">&#10004;</span> Options saved');
?></p></div>
<?php
    } else {
        $rbrpause                  = get_option('rbr_pause');
        $rbrdisableadmin           = get_option('rbr_disableadmin');
        $rbrtype                   = get_option('rbr_type');
        $rbrplace                  = get_option('rbr_place');
        $rbrscroll                 = get_option('rbr_scroll');
        $rbrscrollpercentage       = get_option('rbr_scrollpercentage');
        $rbrscrollpercentagenumber = get_option('rbr_scrollpercentagenumber');
        $rbrevent                  = get_option('rbr_event');
        $rbrnoevent                = get_option('rbr_noevent');
        $rbrtime                   = get_option('rbr_time');
        $rbrnomaxtime              = get_option('rbr_nomaxtime');
    }
?>
<form class="script-form" name="rbr_form" method="post" action="<?php
    echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']);
?>">
<fieldset>
<input type="hidden" name="rbr_show" value="go">
<h2>Give this plugin a break!</h2>
<p>Remove all plugin code from the page source without deactivating the plugin.</p>
<label class="place">
<input type="radio" id="radio1" name="rbr_pause" <?php
    if ($rbrpause == 'pauseyes') {
?> checked="checked" <?php
    }
?> value="pauseyes" size="20">
Yes</label>
<br />
<label class="place">
<input type="radio" id="radio2" name="rbr_pause" <?php
    if ($rbrpause == 'pauseno') {
?> checked="checked" <?php
    }
?> value="pauseno" size="20">
No (Default)</label>
<div class="jbut">Info</div>
<div class="jslid">
<p>If you set this option to yes, the plugin will be disabled. Data will still being send to Google Analytics if the GA tracking code is present on your website.</p> 
<p>If you don't want any tracking data to be send to GA, please remove the tracking code itself.</p>
</div>
<h2>Disable for Administrators only</h2>
<p>Use this plugin for anyone but the Admins.</p>
<label class="place">
<input type="radio" id="radio3" name="rbr_disableadmin" <?php
    if ($rbrdisableadmin == 'disableadminyes') {
?> checked="checked" <?php
    }
?> value="disableadminyes" size="20">
Yes</label>
<br />
<label class="place">
<input type="radio" id="radio4" name="rbr_disableadmin" <?php
    if ($rbrdisableadmin == 'disableadminno') {
?> checked="checked" <?php
    }
?> value="disableadminno" size="20">
No (Default)</label>
<div class="jbut">Info</div>
<div class="jslid">
<p>Some people automatically remove the Google Analytics tracking code for users with an Administrator role. 
When someone doesn’t track Administrators, the code of this plugin will still show up in the page’s source code.</p> 
<p>To remove the code when you don’t track Administrators, choose Yes. The plugin will work for visitors with any other role.</p>
<p>To use the plugin for all visitors (including Administrators), choose No.</p>
</div>
<h2>Tracking Code</h2>
<p>Universal Analytics tracking code (analytics.js), Asynchronous Syntax (ga.js) or Google Analytics by MonsterInsights tracking code</p>
<label class="trackingtype">
<input type="radio" id="radio6" name="rbr_type" <?php
    if ($rbrtype == 'analyticsjs') {
?> checked="checked" <?php
    }
?> value="analyticsjs" size="20">
analytics.js (Recommended) </label>
<br />
<label class="trackingtype">
<input type="radio" id="radio5" name="rbr_type" <?php
    if ($rbrtype == 'gajs') {
?> checked="checked" <?php
    }
?> value="gajs" size="20">
ga.js</label>
<br />
<label class="trackingtype">
<input type="radio" id="radio7" name="rbr_type" <?php
    if ($rbrtype == 'ga4wpjs') {
?> checked="checked" <?php
    }
?> value="ga4wpjs" size="20">
if you are using the <span class="fatred">Google Analytics by MonsterInsights plugin</span> <span class="fatunderlined">AND</span> Universal Tracking is enabled, choose this option</label>
<div class="jbut">Info</div>
<div class="jslid"><span class="jtbold">How do I know what tracking code I am using?</span>
<p>Look at the page's source code.</p>
<p>The analytics.js tracking code looks like this</p>
<?php
    highlight_string("<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview');
</script>");
?>
<br />
<br />
<p>The ga.js tracking code looks more or less like this</p>
<?php
    highlight_string("<script type='text/javascript'>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-XXXXX-X']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>");
?>
<br />
<br />
<p>The Google Analytics by MonsterInsights tracking code looks like this</p>
<?php
    highlight_string("<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');
__gaTracker('create', 'UA-XXXXX-Z', 'auto');
__gaTracker('set', 'forceSSL', true);
__gaTracker('send','pageview');
</script>");
?>
<br />
<br />
<p>For some reason they found it important to change 'ga' to '__gaTracker' in the tracking code.</p>
<strong>Google advises to use analytics.js</strong>
</div>
<h2>Code placement</h2>
<p>Where do you want to put the code?</p>
<label class="place">
<input type="radio" id="radio8" name="rbr_place" <?php
    if ($rbrplace == 'footer') {
?> checked="checked" <?php
    }
?> value="footer" size="20">
Footer (Recommended) </label>
<br />
<label class="place">
<input type="radio" id="radio9" name="rbr_place" <?php
    if ($rbrplace == 'header') {
?> checked="checked" <?php
    }
?> value="header" size="20">
Header (make sure the code is placed after your Google Analytics tracking code) </label>
<div class="jbut">Info</div>
<div class="jslid">
<p>There are a couple of reasons why it’s better to add the plugin’s code to the footer. One is that this code should run after the Google Analytics code, which is probably in the head of your webpage. When you add the plugin’s code to the footer you’ll make sure that it runs after the Analytics code.</p>
<p>A second reason is that this code runs after your webpage has loaded. When the code is placed in the head, your webpage has to wait a little longer before it can start loading (and people can see the webpage).</p>
</div>
<h2>Scroll on page</h2>
<p>Send an event at the first page scroll?</p>
<label class="radio">
<input type="radio" id="radio10" name="rbr_scroll" <?php
    if ($rbrscroll == 'scrollyes') {
?> checked="checked" <?php
    }
?> value="scrollyes" size="20">
Yes </label>
<br />
<label class="radio">
<input type="radio" id="radio11" name="rbr_scroll" <?php
    if ($rbrscroll == 'scrollno') {
?> checked="checked" <?php
    }
?> value="scrollno" size="20">
No (Default)</label>
<div class="jbut">Info</div>
<div class="jslid">
<p>It will only fire an event the first time someone scrolls a page. It is a good indication whether people like the page or not.</p>
<p>It doesn’t say all, though. In some situations there is no scroll event. The text on your page could be so little that people don’t have to scroll. Screen resolutions also matters; your content may not fit on your screen, but maybe someone else has a huge screen with a high resolution.</p>
<p>When people scroll an event will be sent to Analytics which means there is no bounce.</p>
</div>
<h2>Scroll percentage of page</h2>
<p>Send an event when someone scrolls n% of a page?</p>
<label class="radio">
<input type="radio" id="radio12" name="rbr_scrollpercentage" <?php
    if ($rbrscrollpercentage == 'scrollpercentageyes') {
?> checked="checked" <?php
    }
?> value="scrollpercentageyes" size="20">
Yes </label>
<br />
<label class="radio">
<input type="radio" id="radio13" name="rbr_scrollpercentage" <?php
    if ($rbrscrollpercentage == 'scrollpercentageno') {
?> checked="checked" <?php
    }
?> value="scrollpercentageno" size="20">
No (Default)</label>
<br />
<br />
<p>Intervals to send scrolling events to Google Analytics. <span class="whole">100 divided by this number must be a whole number.</span></p>
<label class="textevent"> Every
<input type="text" id="text3" name="rbr_scrollpercentagenumber" value="<?php
    echo $rbrscrollpercentagenumber;
?>" size="1">
%</label>
<div class="jbut">Info</div>
<div class="jslid">
<p>It will fire an event at every scroll percentage mark you choose.</p>
<p>The default setting is 25%. This means that when someone scrolls a page, an event will be fired when the scroll hits the 25% of the page mark, another event at 50%, then at 75% and 100% when they reached the bottom of the page. The options are 2, 4, 5, 10, 20, 25 and 50. I would suggest 25 or 50. <span class="whole">Be aware that a low number will create a lot of events!</span></p>
<p>As soon as a scroll hits the first percentage mark there is no bounce.</p>
</div>
<h2>Fire an event</h2>
<p>Every how many seconds do you want to send the message to Analytics that people are still on the page? <span class="whole">Whole numbers only.</span></p>
<label class="textevent"> Every
<input type="text" id="text1" name="rbr_event" value="<?php
    echo $rbrevent;
?>" size="1">
seconds</label>
<br />
<br />
<label class="textnoevent">
<input type="checkbox" id="noevent" name="rbr_noevent" <?php
    if ($rbrnoevent == 'noeventyes') {
?> checked="checked" <?php
    }
?> value="noeventyes" size="20">
<span class="boldit">I don't want to use time events.</span></label>
<div class="jbut">Info</div>
<div class="jslid">
<p>Google’s limits are 10 million hits per month per property and 500 hits per session. For analytics.js is an additional limit of 200,000 hits per visitor per day. If you go over this limit, additional hits will not be processed for that session (<a class="jtbold" href="https://developers.google.com/analytics/devguides/collection/ios/limits-quotas" target="new">Limits and Quotas</a>)</p>
<p><span class="jtbold">Property</span>. Property means a group of web pages that are linked to an Google Analytics Account.<br />
<span class="jtbold">Hit</span>. A Hit may be a call to the Google Analytics system for instance by Javascript (ga.js, analytics.js), Silverlight, Flash, and Mobile. A Hit may currently be a page view, a transaction, item, or event. <br />
<span class="jtbold">Session</span>. A session is a minimum of 30 minutes long, but will not end until a visitor is inactive for at least 30 minutes. "Inactive" means, more than 30 minutes has passed since the last hit to GA for that visitor. Visitors that leave your site and return within 30 minutes are counted as part of the original session.</p>
<p>This plugin setting generates the most hits. If you want to send an event every 10 seconds to Analytics, you’ll generate 20 hits every 3 minutes for the page view and 10-seconds events only. Other events that are fired (e.g. with another tracking plugin or manual code to links) will come on top of that.<br />
You don’t need to worry if you have a relatively small number of visitors, but with large numbers of visitors you might run out of hits per month.</p>
<p>You should still be OK when you have less than 11,500 visits (sessions) a day. The 11,500 visits created 27,000 pageviews and 300,000 events. Multiply this with 30 and you’re still below 10 million hits per month. Please let me know if you have other ideas about the calculation.</p>
<p>If you exceed this limit you could set the event time to a higher number. Less events will then be fired. You could also reduce the maximum tracking time (next setting).</p>
</div>
<h2>Maximum Tracking Time</h2>
<p>How long do you want to track people on a single page (in seconds). <span class="whole">Whole numbers only.</span></p>
<label class="texttime"> Log for
<input type="text" id="text2" name="rbr_time" value="<?php
    echo $rbrtime;
?>" size="3">
seconds. </label>
<br />
<br />
<label class="textnomaxtime">
<input type="checkbox" id="nomaxtime" name="rbr_nomaxtime" <?php
    if ($rbrnomaxtime == 'nomaxtimeyes') {
?> checked="checked" <?php
    }
?> value="nomaxtimeyes" size="20">
<span class="boldit">I don't want to set a Maximum Tracking Time.</span></label>
<div class="jbut">Info</div>
<div class="jslid">
<p>Default is 15 minutes.</p>
<p>You should look at the Avg. Time on Page stats to find out what Maximum Tracking Time is right for your website. Large content or a video website need a longer Maximum Tracking Time than a website with one-liners.</p>
</div>
<br />
<br />
<button type="submit" class="button-primary">Save options</button>
</fieldset>
</form>
<?php
}
function rbr_settings() {
    global $rbr_settings_page;
    $rbr_settings_page = add_options_page("rbr", "Reduce Bounce Rate", 'manage_options', "rbr", "rbr_options");
}
add_action('admin_menu', 'rbr_settings');

// Add settings link on plugin page
function rbr_settings_link($links) {
    $settings_link = '<a href="options-general.php?page=rbr">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'rbr_settings_link');


function rbr_scripts() {
    if (current_user_can('manage_options') && get_option('rbr_disableadmin') == "disableadminyes") {
    } else {
        $rbrtype = get_option('rbr_type');
        if (get_option('rbr_pause') == "pauseno" && $rbrtype == 'gajs') {
            $rbrplace = get_option('rbr_place');
            wp_enqueue_script('rbr_scripts', plugins_url('js/gajs.js', __FILE__), array(
                'jquery'
            ), '', ($rbrplace == 'footer'));
            
        } elseif (get_option('rbr_pause') == "pauseno" && $rbrtype == 'analyticsjs') {
            $rbrplace = get_option('rbr_place');
            wp_enqueue_script('rbr_scripts', plugins_url('js/analyticsjs.js', __FILE__), array(
                'jquery'
            ), '', ($rbrplace == 'footer'));
        } elseif (get_option('rbr_pause') == "pauseno" && $rbrtype == 'ga4wpjs') {
            $rbrplace = get_option('rbr_place');
            wp_enqueue_script('rbr_scripts', plugins_url('js/ga4wpjs.js', __FILE__), array(
                'jquery'
            ), '', ($rbrplace == 'footer'));
        }
        
        else {
        }
    }
}
add_action('wp_enqueue_scripts', 'rbr_scripts', 999);

function rbr_st_control_vars() {
    if (current_user_can('manage_options') && get_option('rbr_disableadmin') == "disableadminyes") {
    } else {
        if (get_option('rbr_pause') == "pauseno") {
            $rbrscroll                 = (get_option('rbr_scroll') == "scrollyes");
            $rbrscrollpercentage       = (get_option('rbr_scrollpercentage') == "scrollpercentageyes");
            $rbrscrollpercentagenumber = get_option('rbr_scrollpercentagenumber');
            $rbrevent                  = get_option('rbr_event');
            $rbrtime                   = get_option('rbr_time');
            $rbrnoevent                = (get_option('rbr_noevent') == "noeventyes");
            $rbrnomaxtime              = (get_option('rbr_nomaxtime') == "nomaxtimeyes");
?>
<script type="text/javascript">
var trackScrolling=<?php
            echo ($rbrscroll === true) ? 'true' : 'false';
?>;
var trackScrollingPercentage=<?php
            echo ($rbrscrollpercentage === true) ? 'true' : 'false';
?>;
var ScrollingPercentageNumber=<?php
            echo $rbrscrollpercentagenumber;
?>;
var stLogInterval=<?php
            echo $rbrevent;
?>*1000;
var cutOffTime=<?php
            echo $rbrtime;
?>;
var trackNoEvents=<?php
            echo ($rbrnoevent === true) ? 'true' : 'false';
?>;
var trackNoMaxTime=<?php
            echo ($rbrnomaxtime === true) ? 'true' : 'false';
?>;
<?php
            if (is_singular()) {
?>
var docTitle='<?php
                echo str_replace("'", "\'", the_title('', '', false));
?>';
<?php
            }
?>
</script>
<?php
        }
    }
}
add_action('wp_head', 'rbr_st_control_vars', 1);
?>