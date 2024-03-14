$(document).ready(function () 
{
    const student_name = $("#student_name");
    const student_number = $("#student_number");
    const student_email = $("#student_email");
    const student_password = $("#student_password");
    const student_dob = $("#student_dob");
    const update = $("#update");
    update.html("Profile");
    var temp = true;
    student_name.prop("disabled", true);
    student_number.prop("disabled", true);
    student_email.prop("disabled", true);
    student_dob.prop("disabled", true);

    var student_email_value = window.localStorage.getItem("student_email");
    if (student_email_value) 
    {
        $("#student_email").val(student_email_value);
    } 
    else 
    {
        console.log("Student email not found in localStorage.");
    }

    update.click(function (e) 
    {
        e.preventDefault();
     
            $.ajax
            ({
              url: "php/profileview.php",
              type: "POST",
              data: 
              {
                Profile : true,
                student_email: student_email_value,
                student_password : student_password.val()
              },
              success: function (response) 
              {
                  var data = JSON.parse(response);
                  if (data.student_email) 
                  {
                      
                      student_name.val(data.student_name);
                      student_number.val(data.student_number);
                      student_dob.val(data.student_dob);
                      $('#notification').html("Profile Retrieved Successfully");
                      update.html("Go Back");   
                  } 
                  else 
                  {
                      $('#notification').html(data.error);
                      update.html("Go Back");
                      console.log(error);
                  }
              },
              error: function (xhr, status, error) 
                {
                    if (xhr.responseText) 
                    {
                        $('#notification').html(xhr.responseText); 
                        update.html("Go Back");  
                    } 
                    else
                    {
                        $("#notification").html("Error: Something Went Wrong");
                        update.html("Go Back");
                        console.log(error);
                    }
                },
            });
        student_name.prop("disabled", true);
        student_number.prop("disabled", true);
        student_dob.prop("disabled", true);
        student_email.prop("disabled", true);
        student_password.prop("disabled", true);
    });
    update.click(function (e) 
    {
        e.preventDefault();
        if (update.html() === "Go Back") 
        {
            window.location.replace("profile.html");
        }
    });

});
$("#home").click(function (e) 
{
    e.preventDefault();
    window.location.replace("index.html");
});