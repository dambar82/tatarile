  $(document).ready(function(){
    $('#userinfo-address').kladr({
      oneString: true,
      /*type: jQuery.kladr.type.city,*/
      limit: 150,
      change: function (obj) {
        if (obj) {
          var res = obj['typeShort']+". "+obj['name'];
            if (obj['parents']) {
              if (obj['id'] != obj['parents'][0]['id']) {
                /*for(var index in obj['parents']) {
                  res += ", " + obj['parents'][index]['typeShort'] + ". " + obj['parents'][index]['name'];
                }*/
                var length = obj['parents'].length;
                for (var i = length - 1; i >= 0; i--) {
                  if (i == (length-1)) {
                    res += ", " + obj['parents'][i]['typeShort'] + ". " + obj['parents'][i]['name'];
                  } else {
                  if (obj['parents'][i]['name'] != obj['parents'][i+1]['name']) {
                    res += ", " + obj['parents'][i]['typeShort'] + ". " + obj['parents'][i]['name'];
                  }
                  }
                }
              }
            }
            $("#userinfo-address").val(res);
          }
        }
      });
  });
