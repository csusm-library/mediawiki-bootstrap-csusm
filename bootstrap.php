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
	$wgAutoloadClasses['DOMDebugPrinter'] = dirname( __FILE__ ).'/DOMDebugPrinter.php';
	$wgExtensionMessagesFiles['Bootstrap'] = dirname( __FILE__ ).'/Bootstrap.i18n.php';

	$skinDirParts = explode( "/", dirname( __FILE__ ) );
	$skinDir = array_pop( $skinDirParts );
	$skinAssets = $skinDir . '/assets/';
	$bootstrapAssets = $skinDir . '/assets/';
	$wgResourceModules['skins.bootstrap'] = array(
		'styles' => array(
			$skinAssets . 'css/site.css',
			$bootstrapAssets . 'css/bootstrap.min.css',
			$bootstrapAssets . 'css/bootstrap-responsive.min.css',
			$skinAssets . 'font-awesome.css',
			$skinAssets . 'mediawiki.css'
		),
		'scripts' => array(
			$bootstrapAssets . 'js/bootstrap.min.js',
			$skinAssets . 'mediawiki.js',
			$skinAssets . 'site.js'
		),
		'dependencies' => array(
			// jquery automatically loaded [MW > 1.19]
		),
		'remoteBasePath' => &$GLOBALS['wgStylePath'],
		'localBasePath' => &$GLOBALS['wgStyleDirectory'],
	);

	// MW 1.19 ships with jQuery 1.7.1
	if( !version_compare( $wgVersion, '1.19', '==')) {
	array_unshift($wgResourceModules['skins.bootstrap']['scripts'], $skinAssets . 'jquery-1.7.1.min.js');
	}

	$sgNavbarOptions['page'] = 'MediaWiki:bootstrap-navbar';
	$sgNavbarOptions['dropdown'] = true;

	$sgSidebarOptions['page'] = 'MediaWiki:bootstrap-sidebar';
	$sgSidebarOptions['type'] = 'tabs'; # tabs, pills, list
	$sgSidebarOptions['dropdown'] = false;

	$sgFooterOptions['page'] = 'MediaWiki:bootstrap-footer';
