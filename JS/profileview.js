$(document).ready(function () {
    const student_name = $("#student_name");
    const student_number = $("#student_number");
    const student_email = $("#student_email");
    const student_dob = $("#student_dob");
    const student_address = $("#student_address");
    const update = $("#update");
    var temp = true;

    var student_email_value = window.localStorage.getItem("student_email");
    if (student_email_value) {
        $("#student_email").val(student_email_value);
    } else {
        console.log("Student email not found in localStorage.");
    }

    // Function to fetch profile information
    function fetchProfile() {
        var student_email_value = window.localStorage.getItem("student_email");
        if (student_email_value) {
            $.ajax({
                url: "php/profileview.php",
                type: "POST",
                data: {
                    myprofile: true,
                    student_email: student_email_value
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.student_name) {
                        student_name.val(data.student_name);
                        student_number.val(data.student_number);
                        student_dob.val(data.student_dob);
                        student_address.val(data.student_address);
                        student_name.prop("disabled", true);
                        student_number.prop("disabled", true);
                        student_dob.prop("disabled", true);
                        student_email.prop("disabled", true);
                        student_address.prop("disabled", true);

                    } else {
                        $('#notification').html(data.error);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseText) {
                        $('#notification').html(xhr.responseText);
                    } else {
                        $("#notification").html("Error: Something Went Wrong");
                    }
                }
            });
            update.html("Edit");

        } else {
            console.log("Student email not found in localStorage.");
        }
    }

    // Call fetchProfile function when the document is ready
    fetchProfile();

    update.click(function (e) {
        e.preventDefault();
        if (temp) 
        {
            student_name.prop("disabled", false);
            student_number.prop("disabled", false);
            student_dob.prop("disabled", false);
            student_address.prop("disabled", false);
            update.html("Save");
            temp = false;
        } 
        else 
        {
            $.ajax({
                url: "php/profileview.php",
                type: "POST",
                data: {
                    update: true,
                    student_name: student_name.val(),
                    student_number: student_number.val(),
                    student_email: student_email_value,
                    student_dob: student_dob.val(),
                    student_address: student_address.val(),
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.status) {
                        $('#notification').html("Updated Successfully");
                        window.localStorage.setItem('student_name', data.student_name);
                        update.html("Go Back to Home");
                    } else {
                        $('#notification').html(data.error);
                        console.log(data.status);
                        update.html("Go Back to Home");
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseText) {
                        $('#notification').html(xhr.responseText);
                        update.html("Go Back to Home");
                    } else {
                        $("#notification").html("Error: Something Went Wrong");
                        console.log(error);
                        update.html("Go Back to Home");
                    }
                },
            });

            student_name.prop("disabled", true);
            student_number.prop("disabled", true);
            student_dob.prop("disabled", true);
            student_address.prop("disabled", true);
        }
    });

    update.click(function (e) 
    {
        e.preventDefault();
        if (update.html() === "Go Back to Home") 
        {
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
        
        }
    });  
});
