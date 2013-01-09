var url = document.location.toString();
jQuery(document).ready(function(){
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
  if ($('#sidebar-left object').length != 0) {
    if ($('.meebonote').length == 0) {
        $('#sidebar-left object').wrap("<div class='meebonote'></div>");
        $('.meebonote').attr({title: "If the librarian is offline, please include your email address. Thanks!"});
      if ($('#meebo_notice').length == 0) {
          $(".meebonote").append("<div id='meebo_notice'>If the librarian is offline, please include your email address. Thanks!</div>");
        }
    }
     $(".meebonote").hover(function(e){
        $("#meebo_notice").stop(true, true).animate({opacity: "show", top: '40px',right: "-170"}, "fast");
    },
    function(){
      $("#meebo_notice").fadeOut('2500');
    });
    $('.menu_closer').click(function(){$('.jquery-float-menu2 ul').fadeOut('2000');});
  }
});
