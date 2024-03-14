$(document).ready(function() 
{
    $("#view_profile").click(function(e) 
    {
        e.preventDefault();
        $.ajax(
        {
            url: 'Profileviewpage.html', 
            type: 'GET', 
            success: function(response) 
            {
                $('body').html(response);
            }
        });
    });
    $("#update_profile").click(function(e) 
    {
        e.preventDefault();
        $.ajax(
        {
            url: 'profileupdatepage.html', 
            type: 'GET', 
            success: function(response) 
            {
                $('body').html(response);
            }
        });
    });
    $("#logout").click(function(e)
    {
        e.preventDefault();
        window.localStorage.removeItem("student_email");
        window.location.replace("index.html");
    });
});