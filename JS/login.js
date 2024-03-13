$(document).ready(function () 
{
  $("#submit").submit(function(e) 
  {

    e.preventDefault();

    var student_email = $("#student_email").val();
    var student_password = $("#student_password").val();

    if (!student_email || !student_password) 
    {
        $('#notification').text('Please fill in all fields.');
        return; 
    }

        $.ajax
        ({
            url: 'php/login.php',
            type: 'POST',
            data: 
            {
                student_email: student_email,
                student_password: student_password
            },
            success: function(response) 
            {
                var data = JSON.parse(response);
                if (data.status) 
                {
                    window.localStorage.setItem('student_email', student_email);
                    window.location.replace("profile.html");
                } 
                else 
                {
                    console.log(data.status);
                    $("#notification").html(data.msg);
                }
            },
            error: function (xhr, status, error) 
			{
				if (xhr.responseText) 
				{
                    $('#notification').html(xhr.responseText); 
                } 
				else
                {
                    $("#notification").html("Unable to Login");
                    console.log(error);
                }
            }
        });
    });
    $("#signup").click(function (e) 
    {
		e.preventDefault();
        window.localStorage.removeItem('student_email');
		window.location.replace("signuppage.html");
	});
    $("#home").click(function (e) 
    {
		e.preventDefault();
		window.location.replace("index.html");
	});
});