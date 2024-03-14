$(document).ready(function() 
{
    $("#loginLink").click(function(e) 
    {
        e.preventDefault();
        $.ajax (
        {
            url: 'loginpage.html', 
            success: function(response) 
            {
                $('body').html(response);
            }
        });
    });
    
    $("#signuplink").click(function(e) 
    {
        e.preventDefault();
        $.ajax(
        {
            url: 'signuppage.html', 
            type: 'GET', 
            success: function(response) 
            {
                $('body').html(response);
            }
        });
    });
});