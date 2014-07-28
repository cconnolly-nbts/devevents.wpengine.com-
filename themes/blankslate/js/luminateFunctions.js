(function($) {
  $(function() {
    /* define init variables for your organization */
    luminateExtend({
      apiKey: 'thooG9Ke',
      path: {
        nonsecure: 'http://www.braintumorcommunity.org/site/',
        secure: 'https://secure2.convio.net/bts/site/'
      }
    });
    
    /* example: get information on the currently logged in user, and display a "welcome back" message in the site's header */
    window.getUser = function() {
      var getUserCallback = function(data) {
        if(data.getConsResponse && data.getConsResponse.name) {
          $('#login-form').replaceWith('<div class="welcome-back" id="welcome-back"><p>' +
                                         'Hello' + ((data.getConsResponse.name.first) ? (', ' + data.getConsResponse.name.first) : '') + '! ' +
                                         '<a href="' + luminateExtend.global.path.nonsecure + 'ConsProfileUser">Update My Profile</a> |<span id="participant_center_link"></span> <a href="' + luminateExtend.global.path.nonsecure + 'UserLogin?logout=&NEXTURL=' + escape(window.location.href) + '">Logout</a>' +
                                         pcLink + '</p><img src=http://www.braintumorcommunity.org/site/PixelServer /></div>');
          $('.header-login-button').replaceWith('');
          $('#mobileLogin').replaceWith('<div id="login-bar"><div id="barContent"><p>Hello' + ((data.getConsResponse.name.first) ? (', ' + data.getConsResponse.name.first) : '') + '! ' +
                                         '<a href="' + luminateExtend.global.path.nonsecure + 'ConsProfileUser">Update My Profile</a> |<span id="participant_center_link"></span> <a href="' + luminateExtend.global.path.nonsecure + 'UserLogin?logout=&NEXTURL=' + escape(window.location.href) + '">Logout</a>' +
                                         pcLink + '<img class="pixelServer" src=http://www.braintumorcommunity.org/site/PixelServer /></p></div></div>');
          $('.login-help').remove();
          luminateExtend.global.update('cons_id', data.getConsResponse.cons_id);
        }
      };
      luminateExtend.api({
        api: 'cons',
        callback: getUserCallback,
        data: 'method=getUser',
        requestType: 'POST',
        requiresAuth: true
      });
    };
    
    /* example: check if the user is logged in onload */
    /* if they are logged in, call the getUser function above to display the "welcome back" message */
    var loginTestCallback = function(data) {
      if(!data.errorResponse) {
        getUser();
      }
    };
    luminateExtend.api({
      api: 'cons',
      callback: loginTestCallback,
      data: 'method=loginTest'
    });
    
    /* example: handle the login form in the site's header */
    /* if the user is logged in successfully, call the getUser function above to display the "welcome back" message */
    /* if the user is not logged in, display the error message returned by the API in a modal */
    window.loginCallback = {
      error: function(data) {
        $('#cons_id_test').replaceWith('<p>' + data.errorResponse.message + '</p>');
      },
      success: function(data) {
        getUser();
      }
    };
    
    
    window.getUserGroups = function(selector) {
      var userGroupsData = 'method=getUserGroups&cons_id=' + luminateExtend.global.cons_id;
      var getUserGroupsCallback = function(data) {
        $(selector).html('');
        
        var groupList = luminateExtend.utils.ensureArray(data.getConsGroupsResponse.group);
        var count = 0;
        $.each(groupList, function() {
          count = (count+1)
          $(selector).append('<li>' + count + ' ' + data.getConsGroupsResponse.group.id + '</li>');
        });
      };
      
      luminateExtend.api({
        api: 'cons',
        callback: getUserGroupsCallback,
        data: userGroupsData,
        requestType: 'POST',
        requiresAuth: true
      });
    };
    
    /* bind any forms with the "luminateApi" class */
    luminateExtend.api.bind();
  });
})(jQuery);