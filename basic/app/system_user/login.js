$(document).ready(function (){
  // will run if 'create product' form was submitted
  $(document).on('submit', '#login-form', function() {
      // get form data
    var form_data=$(this).serialize();
       // submit form data to api
    $.ajax({
        url: "../api/system_user/login.php",
        type : "POST",
        //contentType : 'application/json',
        data : form_data,
        success : function(resp) {
            // product was created, go back to products list
            var data = JSON.parse(resp);
            if(data['flag']){
              $("#login-notice").removeClass('text-danger').addClass('text-success').html(data['message']);
              localStorage.setItem("user_id", data['user_id']);
              localStorage.setItem("full_name", data['full_name']);
              localStorage.setItem("username", data['username']);
              localStorage.setItem("profile_picture", data['profile_picture']);
              pages.dashboard();
            }else{
              $("#login-notice").addClass('text-danger').html(data['message']);
            }
        },
        error: function(xhr, resp, text) {
            // show error to console
            console.log(xhr, "Error: "+resp, text);
        }
    });
      return false;
  });


  $(document).on('click', '#logmeout', function(){
    localStorage.clear();
    pages.login();
  });
});