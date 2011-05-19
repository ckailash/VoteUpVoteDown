<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * BackendPro
 *
 * A website backend system for developers for PHP 4.3.2 or newer
 *
 * @package         BackendPro
 * @author          Adam Price
 * @copyright       Copyright (c) 2009
 * @license         http://www.gnu.org/licenses/lgpl.html
 * @link            http://www.kaydoo.co.uk/projects/backendpro
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 * Asset Files
 * 
 * Specify all asset files you want to be able to load in the system
 * in the array below. The following details can be specified:
 * 
 * 	file     = The file name of the asset, or URL to external asset
 *  name     = The alternate name for the asset, this overrides the 
 *  	       file name as the default name.
 *  needs    = A list of asset files to load before this asset is loaded
 *  position = Used to overide the default behaviour to output a JS asset
 *  		   to the bottom of the page.
 *  type	 = The type of asset file if the ext does not match .css or .js.
 *  		   This is used when you load a php file which outputs css code.
 *  
 *  Examples:
 *  
 *  $config['asset'][] = array('file'=>'reset.css');
 *  	This will specify a CSS asset file called 'reset.css', to reference
 *  	it in load statements the name 'reset' would be used.
 *  
 *  $config['asset'][] = array('file'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', 'name'=>'jquery');
 *  	This will specify an external JS file and overide the default name
 *  	of 'jquery.min' with the new name 'jquery'
 *  
 *  $config['asset'][] = array('file'=>'jquery.cookie.js', 'needs'=>'jquery', 'position'=>'header');
 *  	This will specify a 'jquery.cookie' asset file which will be loaded in the header
 *  	of the document and also will load the asset reference with the name 'jquery'
 *  	(IE the one above) before it loads this asset.
 * 
 *  $config['asset'][] = array('file'=>'my_php_file.php','type'=>'css');
 *  	This will specify a php asset file which will be treated as if it was a CSS asset.
 */
$config['asset'] = array();

// BackendPro CSS
$config['asset'][] = array('file'=>'reset.css');
$config['asset'][] = array('file'=>'typography.css');
$config['asset'][] = array('file'=>'bep_front_layout.css');
$config['asset'][] = array('file'=>'buttons.css');
$config['asset'][] = array('file'=>'forms.css');
$config['asset'][] = array('file'=>'recaptcha.css');
$config['asset'][] = array('file'=>'bep_admin_layout.css');
$config['asset'][] = array('file'=>'bep_admin_style.css');
$config['asset'][] = array('file'=>'treeview.css');
$config['asset'][] = array('file'=>'bep_generate_password.css', 'name'=>'bep_generate_password.css');
$config['asset'][] = array('file'=>'FlashStatus.css');
$config['asset'][] = array('file'=>'bep_icons.php','type'=>'css');

// BackendPro JS
$config['asset'][] = array('file'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', 'name'=>'jquery');
$config['asset'][] = array('file'=>'http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js', 'name' => 'jquery_ui', 'needs'=>'jquery');
$config['asset'][] = array('file'=>'jquery.cookie.js', 'needs'=>'jquery');
$config['asset'][] = array('file'=>'jquery.treeview.js', 'needs'=>'jquery.cookie');
$config['asset'][] = array('file'=>'bep_dashboard.js', 'needs'=>'jquery_ui|jquery.cookie');
$config['asset'][] = array('file'=>'bep_navigation.js','needs'=>'jquery.cookie|jquery.treeview');
$config['asset'][] = array('file'=>'bep_generate_password.js', 'needs'=>'jquery', 'name'=>'bep_generate_password.js');
$config['asset'][] = array('file'=>'bep_access_control.js', 'needs'=>'jquery.treeview');
$config['asset'][] = array('file'=>'bep_select_all.js', 'needs'=>'jquery');


/**
 * Asset Groups
 * 
 * Specify all asset groups below. This will allow a group
 * of assets to be loaded all at once.
 * 
 * Please use the following format:
 * $config['asset_group']['<group_name>'] = "<asset_1>|<asset_2>|...|<asset_n>";
 * 
 * Where <asset_n> is the name of the asset file specified in the array above.
 */
$config['asset_group']['SITE'] = 'reset|typography';
$config['asset_group']['PUBLIC'] = 'bep_front_layout|FlashStatus';
$config['asset_group']['ADMIN'] = 'bep_admin_layout|bep_admin_style|FlashStatus|forms|buttons|bep_navigation|treeview|bep_icons|bep_select_all';

$config['asset_group']['FORMS'] = "buttons|forms";
$config['asset_group']['GENERATE_PASSWORD'] = "bep_generate_password.css|bep_generate_password.js";



// -----------------------------------------------------------------------



/**
 * CSS Tidy Class Path
 * 
 * The full path to the class.csstidy.php file. Leave blank
 * if you do not want to use CSS tidy or do not have the plugin.
 * 
 * The OPTIMISE_ASSETS option must be set to TRUE to use CSS Tidy
 * 
 * Example: 
 * BASEPATH . "../modules/site/plugins/csstidy/class.csstidy.php"
 * 
 * @var string
 */
$config['csstidy']['path'] = "";

/**
 * CSS Tidy Template
 * 
 * Set the template for CSS Tidy to use. It can be one of the
 * following options:
 * 		highest_compression
 * 		high_compression
 * 		low_compression
 * 		default
 * 
 * @var string
 */
$config['csstidy']['template'] = "highest_compression";

/**
 * CSS Tidy Config
 * 
 * Set the config array for CSS Tidy to use. Please
 * do not change this unless you fully understand what
 * you are changing.
 * 
 * More information can be found here http://csstidy.sourceforge.net/usage.php
 * 
 * @var array
 */
$config['csstidy']['config'] = array(
	'remove_bslash'					=> TRUE,
	'compress_colors' 				=> TRUE,
	'compress_font-weight' 			=> TRUE,
	'lowercase_s'          			=> FALSE,
	'optimise_shorthands'  			=> 1,
	'remove_last_;'		   			=> TRUE,
	'case_properties'      			=> 1,
	'sort_properties'      			=> FALSE,
	'sort_selectors'       			=> FALSE,
	'merge_selectors'      			=> 2,
	'discard_invalid_properties' 	=> FALSE,	
	'css_level'            			=> 'CSS2.1',
	'preserve_css'         			=> FALSE,
	'timestamp'            			=> FALSE);


/**
 * Packer Class Path
 * 
 * The full path to the class.JavaScriptPacker.php file. Leave blank
 * if you do not want to use JS Packer or do not have the plugin.
 * 
 * The OPTIMISE_ASSETS option must be set to TRUE to use CSS Tidy.
 * 
 * There are two versionf of the packer, one for php4 and one for php5.
 * Please make sure you specify the correct filename for your version.
 * 
 * Example: 
 * BASEPATH . "../modules/site/plugins/packer/class.JavaScriptPacker.php4"
 * 
 * TURNING THIS ON CAN BREAK YOUR JS CODE. SO PLEASE ONLY USE IF YOU HAVE
 * FULLY TESTED IT. ALL JS CODE MUST BE UN-MINIMISED/PACKED AS WELL TO
 * WORK
 * 
 * @var string
 */
$config['packer']['path'] = "";

/**
 * Optimise Assets
 * 
 * Set whether to optimise assets upon page load. If set
 * to FALSE the asset files will be included like normal,
 * if set to TRUE all the page asset files will be combined
 * and optimised (dependant on if CSSTidy/JSMin are available).
 * 
 * @var bool
 */
$config['optimise_assets'] = FALSE;

/**
 * Asset Cache Expire Time
 * 
 * Set the period between asset cache files being re-built.
 * The value is in hours. I would advise on a live web server
 * to set this to something like 336hrs (2 weeks) since
 * nothing should change CSS/JS wise in that time.
 * 
 * Setting this value too low can cause a very large increase
 * in page load times.
 * 
 * @var double
 */
$config['asset_caching']['expire_time'] = 48;

/**
 * Asset Cache Path
 * 
 * The full path to the asset cache folder where any cached
 * asset files will be saved.
 * 
 * DO NOT change this from 'assets/cache' since it could
 * cause issues with relative url's in css files. Unless
 * you know exactly what you are doing.
 * 
 * It should be relative to base_url()
 * 
 * @var string
 */
$config['asset_caching']['path'] = "assets/cache/";

/* End of file bep_assets.php */
/* Location: ./modules/site/config/bep_assets.php */