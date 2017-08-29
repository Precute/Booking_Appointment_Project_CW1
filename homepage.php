
 <meta charset='utf-8'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Optional theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <script src='js/jquery.min.js'>
    </script>
    <script src='js/jquery-ui.js'>
    </script>
    <script src='js/jquery-ui-timepicker-addon.js'>
    </script><!-- Latest compiled and minified JavaScript -->

    <script src="js/bootstrap.min.js">
    </script>
    <script src='js/moment.min.js'>
    </script>
       <script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
$('document').ready(function()
{ 
     /* validation */
  $("#login-form").validate({
      rules:
   {
   password: {
   required: true,
   },
   user_email: {
            required: true,
            email: true
            },
    },
       messages:
    {
            password:{
                      required: "Please enter your password"
                     },
            user_email: "Please enter your email address",
       },
    submitHandler: submitForm 
       });  
    /* validation */
    
    /* login submit */
    function submitForm()
    {  
   var data = $("#login-form").serialize();
    
   $.ajax({
    
   type : 'POST',
   url  : 'login.php',
   data : data,
   beforeSend: function()
   { 
    $("#error").fadeOut();
    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
   },
   success :  function(response)
      {      
     if(response=="ok"){
         
      $("#btn-login").html('<img src="images/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
      setTimeout(' window.location.href = "Socrates-studentview.php"; ',4000);
     }
     else{
         
      $("#error").fadeIn(1000, function(){      
    $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
           $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
         });
     }
     }
   });
    return false;
  }
    /* login submit */
});

</script>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Appointment Booking System</h2><hr />
        
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
        </div>

         <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   </button> 
        </div>  
      
      </form>

    </div>
    
</div>