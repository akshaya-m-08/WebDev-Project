$(document).ready(function () 
{
        
    $("#login").submit(function(e) 
    {

        e.preventDefault();

        var student_email = $("#email").val();
        var student_password = $("#password").val();

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
                    window.localStorage.setItem('student_name', data.student_name);
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
    $('#signup').submit(function(e) 
    {
        e.preventDefault();
        var student_name =$('#student_name').val();
        var student_email=$('#student_email').val();
        var student_number=$('#student_number').val();
        var student_dob=$('#student_dob').val();
        var student_password = $('#student_password').val();

        if (!student_email || !student_password || !student_number || !student_dob || !student_name ) 
        {
            $('#notification1').text('Please fill in all fields.');
            return; 
        }

        $.ajax(
        {
            url: "php/signup.php",
            type: "POST",
            data: 
            {
                student_name: student_name,
                student_email:student_email,
                student_number:student_number,
                student_dob:student_dob,
                student_password: student_password
            },
            success: function(response) 
            {
                var result = JSON.parse(response);

                if (result.status) 
                {
                    $('#notification1').html("Registration successful");
                    console.log(result.status);
                    $.ajax (
                        {
                            url: 'login&signuppage.html', 
                            success: function(response) 
                            {
                                console.log("Login and Signup page loaded successfully");
                                $('#maincontent').html(response);
                                setNavFlex(); 
                                $(this).addClass("active");
                                removeActiveClass();
                            }
                        });
                    
                } 
                else 
                {
                    $('#notification1').html(result.msg);
                }
                
            },
            error: function (xhr, status, error) 
            {
                if (xhr.responseText) 
                {
                    $('#notification1').html(xhr.responseText); 
                } 
                else 
                {
                    $('#notification1').html("Unable to process the request. Please try again later.");
                }
            },

        });
    });

    $("#home").click(function (e) 
    {
        e.preventDefault();
        window.location.replace("index.html");
    });
    window.addEventListener('popstate', function(event) 
    {
            window.history.back();
        
    });
});