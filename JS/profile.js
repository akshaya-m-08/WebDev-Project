$(document).ready(function() 
{
    function setNavFlex() {
        $('nav').css('display', 'flex');
    }

    function removeActiveClass() {
        $("#home, #courses, #myprofile").removeClass("active-tab");
    }

    $.ajax({
        url: 'profilehome.html',
        success: function(response) {
            console.log("Home page loaded successfully");
            $('#maincontent').html(response);
            var studentName = window.localStorage.getItem("student_name");
            $('#studentname').text(studentName);
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
            url: 'profilehome.html', 
            success: function(response) 
            {
                console.log("Home page loaded successfully");
                $('#maincontent').html(response);
                var studentName = window.localStorage.getItem("student_name");
                $('#studentname').text(studentName);
                $(this).addClass("active");
                setNavFlex(); 
                removeActiveClass();
            }
        });
    });
    $("#myprofile").click(function(e) 
    {
        e.preventDefault();
        var $this = $(this);
        $.ajax (
        {
            url: 'myprofile.html', 
            success: function(response) 
            {
                console.log("myprofile page loaded successfully");
                $('#maincontent').html(response);
                setNavFlex(); 
                $(this).addClass("active");
                removeActiveClass();
            }
        });
    });
    $("#courses").click(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'mycourses.html',
            success: function(response) {
                console.log("Courses page loaded successfully");
                $('#maincontent').html(response);
                setNavFlex(); 
                $(this).addClass("active");
                removeActiveClass();
            }
        });
    });
    $("#logout").click(function (e) 
    {
        e.preventDefault();
        window.history.replaceState({}, document.title, "/");
        localStorage.clear(); 
        window.location.replace("index.html");
    });
    document.addEventListener('DOMContentLoaded', function() 
    {
       
        const checkbox = document.getElementById('check');
        const navItems = document.querySelectorAll('ul li a');
      
        navItems.forEach(function(item) 
        {
          item.addEventListener('click', function() 
          {
            checkbox.checked = false;
          });
        });
    });


    history.pushState(null, null, 'profile.html');
    window.addEventListener('popstate', function(event) 
    {
        history.pushState(null, null, 'profile.html');
    });

});

