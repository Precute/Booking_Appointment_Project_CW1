var modal;
function viewAllStudent(){
  $(".modal-form").removeClass("dark-matter");
	var modalForm="";
	modal = document.getElementById('myModal');
var result="";     
         $.ajax({
            url: 'find-all-student.php',
           dataType: 'json',
            success: function(data) {   
              modalForm += "<table border=2>";
modalForm += "<tr><th>Student Id<\/th>";
modalForm += "<th>Student Firstname<\/th>";
modalForm += "<th>Student Middlename<\/th>";
modalForm += "<th>Student Surname<\/th>";
modalForm += "<th>Student Email<\/th>";
modalForm += "<th>Student Phone<\/th>";
modalForm += "<th>Student Address<\/th><\/tr>";
               
for(key in data) {
  modalForm += "<tr><td>" + data[key].id + "<\/td> <td> " + data[key].forename + "<\/td> <td>" + data[key].middlename + "<\/td> <td>" + data[key].surname + "<\/td>" + "<td> " + data[key].email + "<\/td>" +"<td> " + data[key].phone + "<\/td>" +"<td> " + data[key].address + "<\/td><\/tr>";
}
   modalForm += "<\/table>";                            
    $(".modal-form").html(modalForm);
  }
            });


  modal.style.display = "block";

}


function addStudent(){
    var modalForm = "";
    var modal = document.getElementById('myModal');
$(".modal-form").addClass("dark-matter");
    modalForm += " <form class=\"form-signin\" method=\"post\" id=\"register-form\">";
    modalForm += "        <div id=\"error\">";
    modalForm += "        <!-- error will be shown here ! -->";
    modalForm += "        <\/div>";
    modalForm += "        ";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"text\" class=\"form-control\" placeholder=\"Forename\" name=\"student-fname\" id=\"student-fname\" \/>";
    modalForm += "        <\/div>";
    modalForm += "";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"text\" class=\"form-control\" placeholder=\"Middlename\" name=\"student-mname\" id=\"student-mname\" \/>";
    modalForm += "        <\/div>";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"text\" class=\"form-control\" placeholder=\"Surname\" name=\"student-surname\" id=\"student-surname\" \/>";
    modalForm += "        <\/div>";
    modalForm += "";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"text\" class=\"form-control\" placeholder=\"Phone Number\" name=\"student-phone\" id=\"student-phone\" \/>";
    modalForm += "        <\/div>";
    modalForm += "";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <textarea rows=\"4\" class=\"form-control\" placeholder=\"Address\" name=\"student-address\" id=\"student-address\"><\/textarea>";
    modalForm += "        <\/div>";
    modalForm += "";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"email\" class=\"form-control\" placeholder=\"Email address\" name=\"student-email\" id=\"student-email\" \/>";
    modalForm += "        <span id=\"check-e\"><\/span>";
    modalForm += "        <\/div>";
    modalForm += "        ";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"password\" class=\"form-control\" placeholder=\"Password\" name=\"student-password\" id=\"student-password\" \/>";
    modalForm += "        <\/div>";
    modalForm += "        ";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "        <input type=\"password\" class=\"form-control\" placeholder=\"Retype Password\" name=\"cpassword\" id=\"cpassword\" \/>";
    modalForm += "        <\/div>";
    modalForm += "      <hr \/>";
    modalForm += "        ";
    modalForm += "        <div class=\"form-group\">";
    modalForm += "            <button type=\"submit\" class=\"btn btn-default\" name=\"btn-save\" id=\"btn-submit\">";
    modalForm += "      <span class=\"glyphicon glyphicon-log-in\"><\/span> &nbsp; Create Account";
    modalForm += "   <\/button> ";
    modalForm += "        <\/div>  ";
    modalForm += "      ";
    modalForm += " <\/form>";
    $('.modal-form').html(modalForm);
 modal.style.display = "block";
    $('.modal-title').html('Add New Student');
    
    $('document').ready(function() {
        /* validation */
        $("#register-form").validate({
            rules: {
                 user_forename: {
                    required: true,
                    minlength: 2
                },
                                 user_surname: {
                    required: true,
                    minlength: 2
                },
                                 user_address: {
                    required: true,
                    minlength: 2
                },
                user_name: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 15
                },
                cpassword: {
                    required: true,
                    equalTo: '#student-password'
                },
                user_email: {
                    required: true,
                    email: true
                }

            },
            messages: {
                user_name: "Please enter user name",
                password: {
                    required: "Please provide a password",
                    minlength: "Password at least have 8 characters"
                },
                user_email: "Please enter a valid email address",
                cpassword: {
                    required: "Please retype your password",
                    equalTo: "Password doesn't match!"
                },
                user_address: {
                    required: "Please provide a valid address",
                    minlength: "Address requires a minimum of 2 characters"
                }

            },
            submitHandler: submitForm
        });
        /* validation */

        /* form submit */
        function submitForm() {
                var data = $("#register-form").serialize();

                $.ajax({

                    type: 'POST',
                    url: 'add_student.php',
                    data: data,
                    beforeSend: function() {
                        $("#error").fadeOut();
                        $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Sending ...');
                    },
                    success: function(data) {
                        if (data == 1) {

                            $("#error").fadeIn(1000, function() {


                                $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken!</div>');

                                $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

                            });

                        } else if (data == "addedregistered") {

                            $("#btn-submit").html('<img src="css/images/btn-ajax-loader.gif" /> &nbsp; Signing Up ...');
                            setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("Socrates-Socratesview.php"); }); ', 5000);
                            $('#eventModal').modal('hide');
                            alert("New Student Added!");
                        } else {

                            $("#error").fadeIn(1000, function() {

                                $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + data + '!</div>');

                                $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

                            });

                        }
                    }
                });
                return false;
            }
            /* form submit */

    });
}