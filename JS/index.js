$(document).ready(function() 
{
    function setNavFlex() {
        $('nav').css('display', 'flex');
    }

    function removeActiveClass() {
        $("#home, #about, #courses, #studentlogin").removeClass("active-tab");
    }
    
    $(document).on('click', '.toggle-password', function() {
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $($(this).attr('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });

    $(document).on('click', '.signupcard .toggle-password', function() {
        $(this).toggleClass('fa-eye fa-eye-slash');
        var input = $($(this).attr('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });

    $.ajax({
        url: 'home.html',
        success: function(response) {
            console.log("Home page loaded successfully");
            $('#maincontent').html(response);
            $("#home").addClass("active");
            setNavFlex(); 
            removeActiveClass();

        }
    });

    $("#home").click(function(e) 
    {
        e.preventDefault();
        var $this = $(this);
        $.ajax (
        {
            url: 'home.html', 
            success: function(response) 
            {
                console.log("Home page loaded successfully");
                $('#maincontent').html(response);
                $(this).addClass("active");
                setNavFlex(); 
                removeActiveClass();
            }
        });
    });

    $("#studentlogin").click(function(e) 
    {
        e.preventDefault();
        var $this = $(this);
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
    });   

    $("#about").click(function(e) 
    {
        e.preventDefault();
        var $this = $(this);
        $.ajax(
        {
            url: 'about.html', 
            success: function(response) 
            {
                console.log("About page loaded successfully");
                $('#maincontent').html(response)
                setNavFlex(); 
                $(this).addClass("active");
                removeActiveClass();
            }
        });
    });
    $("#courses").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'courses.html',
            success: function(response) {
                console.log("Courses page loaded successfully");
                $('#maincontent').html(response);
                setNavFlex(); 
                $(this).addClass("active");
                removeActiveClass();
            }
        });
    });
});