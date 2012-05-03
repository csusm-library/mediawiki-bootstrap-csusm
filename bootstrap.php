<?php
/**
 * Bootstrap Skin
 * 
 * @file
 * @ingroup Skins
 * @author Matt Yeh (http://www.github.com/mtyeh411)
 * licence http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

	if( !defined( 'MEDIAWIKI' ) ) die( "This is a skin extension to the MediaWiki package and cannot be run standalone." );

	$wgExtensionCredits['skin'][] = array(
		'path' => __FILE__,
		'name' => 'Bootstrap',
		'url' => 'http://www.github.com/mtyeh411/bootstrap-mediawiki',
		'author' => '[http://www.github.com/mtyeh411 Matt Yeh]',
		'descriptionmsg' => 'Bootstrap skin',
	);

	$wgValidSkinNames['bootstrap'] = 'Bootstrap';
	$wgAutoloadClasses['SkinBootstrap'] = dirname( __FILE__ ).'/Bootstrap.skin.php';
	$wgAutoloadClasses['BootstrapRenderer'] = dirname( __FILE__ ).'/Bootstrap.renderer.php';
	$wgExtensionMessagesFiles['Bootstrap'] = dirname( __FILE__ ).'/Bootstrap.i18n.php';

	$wgResourceModules['skins.bootstrap'] = array(
		'styles' => array(
			'bootstrap/assets/css/bootstrap.css',
			'bootstrap/assets/css/bootstrap-responsive.css',
			'bootstrap/assets/css/site.css',
		),
		'scripts' => array(
			//'bootstrap/assets/site.js',
			//'bootstrap/assets/js/bootstrap-tabs.js',
			'bootstrap/assets/js/bootstrap-dropdown.js',
			'bootstrap/assets/js/bootstrap-transition.js',
			'bootstrap/assets/js/bootstrap-collapse.js',
		),
		'dependencies' => array(
			// jquery automatically loaded
		),
		'remoteBasePath' => &$GLOBALS['wgStylePath'],
		'localBasePath' => &$GLOBALS['wgStyleDirectory'],
	);	

	
	$sgNavbarOptions['page'] = 'Bootstrap:Navbar';
	$sgNavbarOptions['dropdown'] = true; 

	$sgSubnavOptions['page'] = 'Boostrap:Subnav';
	$sgSubnavOptions['type'] = 'tabs'; # tabs, pills, list
	$sgSubnavOptions['dropdown'] = true;

	$sgSidebarOptions['page'] = 'Bootstrap:Sidebar';
	$sgSidebarOptions['type'] = 'pills'; # tabs, pills, list
	$sgSidebarOptions['dropdown'] = true;

	$sgFooterOptions['page'] = 'Bootstrap:Footer';