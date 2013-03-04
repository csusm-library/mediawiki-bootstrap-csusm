var url = document.location.toString();
jQuery(document).ready(function(){
  jQuery('#leftnav ul').addClass("dropdown-menu").removeClass('nav-tabs');
  jQuery(".item-infolink").html("dbinfo");
  jQuery(".item-infolink").attr('title', 'Show database descriptions');
  jQuery(".item-infolink").live('click',function(){
    jQuery(this).next(".item-desc").slideToggle(500);
        _gaq.push(['_trackPageview', '/databases/info']);
  });
  jQuery(".expandable").live('click',function(){
    jQuery(this).parent('h2').next(".module").slideToggle(500);
    jQuery(this).toggleClass('closed');
  });
  jQuery('.dblist-layout a.item-title').click(function(){
    var title = $(this).text();
    var outbound = '/external/dbs/' + title;
    _gaq.push(['_trackPageview', outbound]);
    location.href = $(this).attr("href");
  });
  jQuery('.footer ul').addClass("nav nav-pills");
});
