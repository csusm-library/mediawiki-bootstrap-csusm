<?php
/**
 * Skin file for skin Bootstrap.
 *
 * @file
 * @ingroup Skins
 */

 	/**
 	* SkinTemplate class for Bootstrap skin
 	* @ingroup Skins
 	*/
 	class SkinBootstrap extends SkinTemplate {

		var $skinname = 'bootstrap', $stylename = 'bootstrap',
			$template = 'BootstrapTemplate', $useHeadElement = true;

		/**
		* @param $out OutputPage object
		*/
		public function initPage( OutputPage $out ) {
			parent::initPage( $out );
			$out->addModuleScripts( 'skins.bootstrap' );
			$out->addMeta("viewport", "width=device-width, initial-scale=1.0");
			$out->addScriptFile( "//html5shiv.googlecode.com/svn/trunk/html5.js" );
		}

		/**
		* @param $out OutputPage object
		*/
		function setupSkinUserCss( OutputPage $out ) {
			parent::setupSkinUserCss( $out );
			$out->addModuleStyles( 'skins.bootstrap' );
		}
	}

	/**
	* BaseTemplate class for Bootstrap skin
	* @ingroup Skins
	*/
	class BootstrapTemplate extends BaseTemplate {

		/**
		*	Outputs the entire context of the page
		*/
		public function execute() {
			global $wgUser, $wgVersion, $sgSidebarOptions,$wgTitle;
			$renderer = new BootstrapRenderer( $this, $this->data );

			// Suppress warnings to prevent notices about missing indexes in $this->data
			wfSuppressWarnings();

			$this->html( 'headelement' ); ?>

			<!-- Deprecation warning -->
			<?php	$context = $this->data['skin']->getContext();
						$oldNavbarArticle = Article::newFromTitle(Title::newFromText( 'Bootstrap:Navbar'), $context );
						$oldSidebarArticle = Article::newFromTitle(Title::newFromText( 'Bootstrap:Sidebar'), $context );
						$oldFooterArticle = Article::newFromTitle(Title::newFromText( 'Bootstrap:Footer'), $context );
						if( (method_exists($oldNavbarArticle,"getPage") && $oldNavbarArticle->getPage()->exists()) ||
								(method_exists($oldSidebarArticle,"getPage") && $oldSidebarArticle->getPage()->exists()) ||
								(method_exists($oldFooterArticle,"getPage") && $oldFooterArticle->getPage()->exists()) ) {
							print( "DEPRECATION WARNING from MediaWiki-Bootstrap: delete Bootstrap:Navbar, Bootstrap:Sidebar, and Bootstrap:Footer, and place contents in MediaWiki:bootstrap-navbar, MediaWiki:bootstrap-sidebar, and MediaWiki:bootstrap-footer");
						}
				?>

			<!-- ===== Navbar ===== -->
			<?php $renderer->renderNavbar(); ?>

			<!-- ===== Page ===== -->
			<div id="page" class="container container-fluid">

				<!-- ===== Site notice ===== -->
					<?php if($this->data['sitenotice']) { ?>
						<header class="row-fluid">
							<div id="siteNotice" class="alert alert-info span12">
								<button class="close" data-dismiss="alert">x</button>
								<?php $this->html('sitenotice') ?>
							</div>
						</header>
					<?php } ?>

				<div class="row-fluid">
					<!-- ===== Sidebar ===== -->
					<?php $sidebarArticle = Article::newFromTitle(Title::newFromText( $sgSidebarOptions['page']), $this->data['skin']->getContext() );
						if( $sidebarArticle->getContent() != '' ) { ?>
							<div class="span3">
								<?php if($wgTitle == "Business Research Guide" || $wgTitle == "Business Research Wiki" ||  $wgTitle == "Main Page"){ ?>
										<?php $renderer->renderSidebar(); ?>
								<?php } ?>
								<?php if($wgTitle != "Business Research Guide" && $wgTitle != "Business Research Wiki" &&  $wgTitle != "Main Page"){ ?>
									<div class="dropdown" id="leftnav">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#">Business Resources by Subject <icon class="icon-chevron-right"></icon></a>
												<?php $renderer->renderSidebar(); ?>
									</div>
									<iframe title="contact Panel" src="https://biblio.csusm.edu/widgets/libpeople/widget.php?person=afiegen&amp;site=micro" frameborder="0" scrolling="no" width="100%" height="720" style="max-width:258pxmargin-top:20px"></iframe>
								<?php } ?>
							</div>
					<?php $contentSpanSize = "9"; } ?>

					<!-- ===== Article ===== -->
					<div class="span<?php echo $contentSpanSize?>">
						<div class="page-header">
							<h1>
								<?php $this->html( 'title' ) ?>
								<small><?php $this->html( 'subtitle' ) ?></small>
							</h1>
						</div>
						<?php $this->html( 'bodycontent' ); ?>
						<?php if($wgTitle == "Business Databases"){ ?>
							<script type="text/javascript">
								function getDrupalFeed(feed){
								  $.getJSON("//biblio.csusm.edu/research_portal/databases/subjects/"+feed+"/most-useful/feed?format=json&callback=?");
								  $.getJSON("//biblio.csusm.edu/research_portal/databases/subjects/"+feed+"/also-useful/feed?format=json&callback=?");
								  $("#db-layout").attr("class","dblist-layout");
								  $("#db-layout").attr("id","db-layout-"+feed);
								  $("#db-layout-"+feed).append('<table id="most-useful-'+feed+'" class="table table-hover"><tr><th class="views-field-title">Database</th><th class="views-field-phpcode">Full Text</th><th class="views-field-field-coverage-to-value">Coverage</th><th class="views-field-field-scholarly-value">Scholarly</th></tr></table>');
								}

								function topdbs(data){
								  $.each(data, function(i,item){
								    if(i<1){
								      $("#most-useful-"+item.nid_1.content).before('<h3>'+item.title_1.content+'</h3>');
								    }
								    $("#most-useful-"+item.nid_1.content).append('<tr><td><a class="item-title" href="'+item.nid.content+'">'+item.title.content+'</a>'+item.field_annotation_value.content+'</td><td class="item-ft">'+item.field_full_text_value.content+'</td><td class="item-coverage">'+item.field_coverage_to_value.content.replace('currentcurrent', 'current')+'</td><td>'+item.field_scholarly_value.content+'</td></tr>');
								  });
								}
								function moredbs(data){
								  if (data.length > 0){
								    $.each(data, function(j,item){
								      if(j<1){
								        $("#db-layout-"+item.nid_1.content+" h3").text('Most Useful');
								        $("#most-useful-"+item.nid_1.content).after('<h3>Also Useful</h3><table id="also-useful-'+item.nid_1.content+'" class="table table-hover"><tr><th class="views-field-title">Database</th><th class="views-field-phpcode">Full Text</th><th class="views-field-field-coverage-to-value">Coverage</th><th class="views-field-field-scholarly-value">Scholarly</th></tr></table>');
								      }
								    $("#also-useful-"+item.nid_1.content).append('<tr><td><a class="item-title" href="'+item.nid.content+'">'+item.title.content+'</a>'+item.field_annotation_value.content+'</td><td class="item-ft">'+item.field_full_text_value.content+'</td><td class="item-coverage">'+item.field_coverage_to_value.content.replace('currentcurrent', 'current')+'</td><td>'+item.field_scholarly_value.content+'</td></tr>');
								    });
								  }
								}
							</script>
							<div id="db-layout"></div>
							<script type="text/javascript">getDrupalFeed(8865)</script>
						<?php } ?>
						<?php if($wgTitle == "Business Research Guide" || $wgTitle == "Business Research Wiki" || $wgTitle == "Main Page"){
							echo "<div class=\"row-fluid\">";
								echo "<div class=\"column span6\">";
									include($IP.'assets/feeds/business-guides.php');
								echo "</div>";
								echo "<div class=\"column span6\">";
									echo "<iframe title=\"contact Panel\" src=\"https://biblio.csusm.edu/widgets/libpeople/widget.php?person=afiegen&amp;site=micro\" frameborder=\"0\" scrolling=\"no\" width=\"98%\" height=\"720\"></iframe>";
								echo "</div>";
							echo "</div>";
						} ?>
						<?php $renderer->renderCatLinks(); ?>
						<?php $this->html( 'dataAfterContent' ); ?>
					</div>
				</div>

				<!-- ===== Footer ===== -->
				<?php $renderer->renderFooter(); ?>

			</div> <!-- #page .container-fluid -->

			<?php $this->printTrail(); ?>

			</body>
			</html>
			<?php wfRestoreWarnings();
	}
}
