<?php
session_start();


if(!isset($_SESSION['user_session']))
{
echo $_SESSION["user_name"];
 header("Location: homepage.php");
}

include_once 'connection.php';

$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
//echo $login_session; 

if(!isset($_SESSION['user_email']))
{
echo $_SESSION["user_name"];
 header("Location: homepage.php");
}


$stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_email=:user_email");
$stmt->execute(array(":user_email"=>$_SESSION['user_email']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
//echo $login_session; 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title> Socrates | Student View </title>
    <link href='css/jquery-ui.css' rel='stylesheet'>
    <link href='css/fullcalendar.css' rel='stylesheet'>
    <link href='css/fullcalendar.print.css' media='print' rel='stylesheet'>
    <link href='css/custom.css' rel='stylesheet'><!-- Latest compiled and minified CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='css/jquery-ui-timepicker-addon.css' rel='stylesheet' type='text/css'><!-- Optional theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
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
    <script src='js/fullcalendar.min.js'>
    </script>
        <script src='js/socrates.js'>
    </script>
    <script>
                                  $( function() {
                                   $( "#menu" ).menu();
                                 } );
    </script>
    <script type="text/javascript">
                               $(document).ready(function() {
                               $('#nav').load('nav.html');
                               });
    </script>
    <script>
                                      $(document).ready(function() {
                                          var modalForm = "";
                                          // Get the modal
                                          var modal = document.getElementById('myModal');
                                          // Get the <span> element that closes the modal
                                          var span = document.getElementsByClassName("close")[0];

                                          // When the user clicks on <span> (x), close the modal
                                          span.onclick = function() {
                                              modal.style.display = "none";
                                          }

                                          // When the user clicks anywhere outside of the modal, close it
                                          window.onclick = function(event) {
                                              if (event.target == modal) {
                                                   modal.style.display = "none";
                                              }
                                          }

                                          var date = new Date();
                                          var d = date.getDate();
                                          var m = date.getMonth();
                                          var y = date.getFullYear();
                                          var calendar = $('#calendar').fullCalendar({

                                              header: {
                                                  left: 'prev,next today',
                                                  //center: 'title',
                                                  right: 'month,agendaWeek,agendaDay'
                                              },

                                              businessHours: {
                                              // days of week. an array of zero-based day of week integers (0=Sunday)
                                              start: '07:00', // a start time 7am 
                                              end: '21:00',
                                              dow: [ 1, 2, 3, 4, 5 ] // Monday - Friday 
                                              },

                                              defaultDate: '2017-05-07',
                                              defaultView: 'agendaWeek',
                                              editable: true,
                                              minTime: '7:0',
                                              maxTime: '20:30',

                                              
                                              events: "events.php",
                                              allDaySlot: true,
                                              //element.qtip(event.availability),
                                              //description: 'availability',
                                  

                                             
                                             //element.find('.fc-title').append("<br/>" + event.description); 
                                             eventRender: function(event, element) { 
                                                element.find('.fc-title').append("<br/>" + event.availability); 
                                               },

                                              eventAfterRender: function(event, element, view) {

                                                  if (event.availability == 0) {
                                                      //event.color = "#FFB347"; //Em andamento
                                                      element.css('background-color', '#FF0000');
                                                  } else if (event.availability >= 0) {
                                                      //event.color = "#77DD77"; //Concluído OK
                                                      element.css('background-color', '#77DD77');
                                                  }
                                                   
                                              },

                                              eventClick: function(calEvent, jsEvent, view) {
                                                
                         var loginEmail ;
                        var loginid;
                    $.ajax({
                    method: "POST",
                    url: "userid.php",
                    cache: false,
                    async: false,
                    success: function(data) {
                        loginid = data;
                    }
                });
          $.ajax({
                    method: "POST",
                    url: "userEmail.php",
                    cache: false,
                    async: false,
                    success: function(data) {
                        loginEmail = data;
                    }
                });

if(calEvent.availability > 0){$(".modal-form").addClass("dark-matter");                                                 
modalForm =" <form method=\"post\"><h1>Book An Event</h1>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-text-input\" class=\"col-2 col-form-label\">Student Email : "+ loginEmail +"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-text-input\" class=\"col-2 col-form-label\">Student ID : "+ loginid+"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-text-input\" class=\"col-2 col-form-label\">Course Name : "+ calEvent.title +"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-text-input\" class=\"col-2 col-form-label\">Course Code : "+ calEvent.id +"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-search-input\" class=\"col-2 col-form-label\">Number of slot Available : "+ calEvent.availability+"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-search-input\" class=\"col-2 col-form-label\">Apointment Type : "+ calEvent.apptype+"<\/label>";
modalForm += "<\/div>";
modalForm += "<div class=\"form-group \">";
    modalForm += "            <button type=\"submit\" class=\"btn btn-default\" name=\"btn-save\" id=\"book-submit\">";
    modalForm += "       Book";
    modalForm += "   <\/button> ";
    modalForm += "        <\/div>  ";
    modalForm += "      ";
    modalForm += " <\/form>";


     $('.modal-form').html(modalForm);
      modal.style.display = "block";

    var bkForm = document.getElementById('book-Form');

 document.getElementById("book-submit").addEventListener("click", submitBooking, true);
 var title1 = calEvent.Title;
 //title1 = document.getElementById("input").value;


 function submitBooking(){
  var eventid = calEvent.id;
  var availability = calEvent.availability;
  availability = availability - 1;
  // $.post("appBooking.php", 

     $.post("appBooking.php", {
                                appid: eventid,
                                //student_id: loginid,
                                availability: availability
                            },
                          function() {
                                console.log("Created.");
                            });
           

 }
   
calendar.fullCalendar('unselect');
  }
  else if (calEvent.availability == 0) 
  {
     $(".modal-form").addClass("dark-matter");                                                 
modalForm =" <form method=\"post\"><h1>Book An Event</h1>";
modalForm += "<div class=\"form-group row\">";
modalForm += "  <label for=\"example-text-input\" class=\"col-2 col-form-label\">This Slot is fully Booked<\/label>";


modalForm += "  <\/div>";
modalForm += "<\/div>";
    modalForm += " <\/form>";
     $('.modal-form').html(modalForm);
      modal.style.display = "block";
  }

                 

                                         
                                                  

                                              
                                              },

                                          });



                                      });


      
    </script>
    <style>
     body {
           margin: 40px 10px;
           padding: 0;
           font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
           font-size: 14px;
          }
      #calendar {
           max-width: 900px;
           margin: 0 auto;
                }
       .fc-clear {
           clear: none !important;
           }

          .btn {
    width:78%;
  }
  @media 
  only screen and (max-width: 760px),
  (min-device-width: 768px) and (max-device-width: 1024px)  {
  
    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr { 
      display: block; 
    }
    
    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr { 
      position: absolute;
      top: -9999px;
      left: -9999px;
    }
    
    tr { border: 1px solid #ccc; }
    
    td { 
      /* Behave  like a "row" */
      border: none;
      border-bottom: 1px solid #eee; 
      position: relative;
      padding-left: 50%; 
    }
    
    td:before { 
      /* Now like a table header */
      position: absolute;
      /* Top/left values mimic padding */
      top: 6px;
      left: 6px;
      width: 45%; 
      padding-right: 10px; 
      white-space: nowrap;
    }
    
    /*
    Label the data
    */
    td:nth-of-type(1):before { content: "First Name"; }
    td:nth-of-type(2):before { content: "Last Name"; }
    td:nth-of-type(3):before { content: "Job Title"; }
    td:nth-of-type(4):before { content: "Favorite Color"; }
    td:nth-of-type(5):before { content: "Wars of Trek?"; }
    td:nth-of-type(6):before { content: "Porn Name"; }
    td:nth-of-type(7):before { content: "Date of Birth"; }
    td:nth-of-type(8):before { content: "Dream Vacation City"; }
    td:nth-of-type(9):before { content: "GPA"; }
    td:nth-of-type(10):before { content: "Arbitrary Data"; }
  }
  
  /* Smartphones (portrait and landscape) ----------- */
  @media only screen
  and (min-device-width : 320px)
  and (max-device-width : 480px) {
    body { 
      padding: 0; 
      margin: 0; 
      width: 320px; }
    }
  
  /* iPads (portrait and landscape) ----------- */
  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
    body { 
      width: 495px; 
    }
  }
    </style>

    <title>
    </title>
</head>

<body>
       <!-- The Modal -->
    <div class="modal" id="myModal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">x</span>
            <div class="modal-form"></div>
        </div>
    </div>
   
    <div id='nav'></div>


    <div style="float:left; width: 160px; padding-top:20px;">
        <ul id="menu">
            <li>
                <div>
                    <a href="#"><span class="glyphicon glyphicon-education" style="margin-right: 0.5em"></span>Student Account</a>
                </div>


                <ul>
                    <li onclick="">
                        <div>
                            <span class="glyphicon glyphicon-search" style="margin-right: 0.5em"></span>View My Records
                        </div>
                    </li>


                    <li>
                        <div onclick="">
                            <span class="glyphicon glyphicon-plus" style="margin-right: 0.5em"></span>Edit Details
                        </div>
                    </li>
                </ul>
            </li>


            <li>
                <div>
                    <span class="glyphicon glyphicon-calendar" style="margin-right: 0.5em"></span>Log
                </div>


                <ul>
                    <li>
                        <div onclick="">
                            <span class="glyphicon glyphicon-plus" style="margin-right: 0.5em"></span>Show History
                        </div>
                    </li>


                    <li>
                        <div>
                            <span class="glyphicon glyphicon-search" style="margin-right: 0.5em"></span>View Attendance
                        </div>
                    </li>
                </ul>
            </li>


         


            <li>
                <div>
                    <span class="glyphicon glyphicon-log-out" style="margin-right: 0.5em"></span><a href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
            <ul>
          <li>
         <div>
                <span class="glyphicon glyphicon-eye-open" style="margin-right: 0.5em"></span> Note:
        </div>
      </li>
      <div class="btn-group">
    <button type="button"  class="btn btn-danger" custom>Unavailable</button>
    <button type="button" class="btn btn-success" custom>Available </button>
</div>
       </ul>
    </div>


    <div style="margin-left: 160px;">
        <div id='calendar'></div>
    </div>

</body>
</html>