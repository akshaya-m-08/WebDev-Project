$(document).ready(function() 
{
	$('#submit').submit(function(e) 
	{
		e.preventDefault();
        var student_name =$('#student_name').val();
		var student_email=$('#student_email').val();
        var student_number=$('#student_number').val();
        var student_dob=$('#student_dob').val();
		var student_password = $('#student_password').val();

		if (!student_email || !student_password || !student_number || !student_dob || !student_name ) 
    	{
        	$('#notification').text('Please fill in all fields.');
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
					$('#notification').html("Registration successful");
					console.log(result.status);
					
				} 
				else 
				{
					$('#notification').html(result.msg);
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
                    $('#notification').html("Unable to process the request. Please try again later.");
                }
			},

		});
    });
	$("#login").click(function (e) 
	{
		e.preventDefault();
	
		window.localStorage.removeItem("student_email");
		window.location.replace("loginpage.html");
	});
	$("#home").click(function (e) 
    {
		e.preventDefault();
		window.location.replace("index.html");
	});
});
