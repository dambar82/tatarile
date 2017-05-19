function View(view)
{
  if(view=='grid')
  {
    $(".filter_container").removeClass("view_table").addClass("view_grid");
    $(".contents_view .view_grid_btn").addClass("active");
    $(".contents_view .view_table_btn").removeClass("active");
  }
  if(view=='table')
  {
    $(".filter_container").removeClass("view_grid").addClass("view_table");
    $(".contents_view .view_table_btn").addClass("active");
    $(".contents_view .view_grid_btn").removeClass("active");
  }
  //document.cookie="color="+color+"";
  var url = location.hostname+(location.port ? ':'+location.port : '');
  set_cookie ("view", view, "", "", "", "/", url, "");
}

function getCookie(name) {
  var cookie = " " + document.cookie;
  var search = " " + name + "=";
  var setStr = null;
  var offset = 0;
  var end = 0;
  if (cookie.length > 0) {
    offset = cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      end = cookie.indexOf(";", offset)
      if (end == -1) {
        end = cookie.length;
      }
      setStr = unescape(cookie.substring(offset, end));
    }
  }
  return(setStr);
}
function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure ) {
  var cookie_string = name + "=" + escape ( value );

  if ( exp_y )
  {
    var expires = new Date ( exp_y, exp_m, exp_d );
    cookie_string += "; expires=" + expires.toGMTString();
  }

  if ( path )
        cookie_string += "; path=" + escape ( path );

  if ( domain )
        cookie_string += "; domain=" + escape ( domain );

  if ( secure )
        cookie_string += "; secure";

  document.cookie = cookie_string;
}


  if(getCookie("view"))
  {
    View(getCookie("view"));
  } else {
    View("grid");
  }
$(document).ready(function() {
  if(getCookie("view"))
  {
    View(getCookie("view"));
  } else {
    View("grid");
  }

})
