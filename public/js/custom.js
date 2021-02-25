/** Scroll to top  **/

window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        document.getElementById("scroll-btn").style.display = "block";
    } else {
        document.getElementById("scroll-btn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document

function topFunction() {
    // document.body.scrollTop = 0; // For Safari

    // document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

    $(window.opera ? "html" : "html, body").animate({
            scrollTop: 0,
        },
        "slow"
    );
}

/** Scroll to top  **/

// Toggle Sidebar On Mobile

$(".toggleNav").click(function() {
    $("#left-sidebar").toggleClass("toggle");

    $(".toggleNav").addClass("hidden");

    $(".toggleNav2").removeClass("hidden");

    $(".toggleNav2").addClass("inline-block");
});

$(".toggleNav2").click(function() {
    $("#left-sidebar").toggleClass("toggle");

    $(".toggleNav2").addClass("hidden");

    $(".toggleNav").removeClass("hidden");
});

/**
 *
 * start coding for custom js
 *
 */
var token = $("meta[name=csrf_token]").attr("content");

// for check user name

$(".candidate-username-check").on("keyup", function(e) {
    var alert = $(".candidate-username-error");
    var username = $(this).val();
    var signup = $(".sign-up-candidate");
    usernameCheck(alert, username, signup);
});
$(".employee-username-check").on("keyup", function(e) {
    var alert = $(".employee-username-error");
    var username = $(this).val();
    var signup = $(".sign-up-employee");
    usernameCheck(alert, username, signup);
});

function usernameCheck(alert, username, signup) {
    alert.empty();
    if (username != "") {
        if (username.trim().length >= 5) {
            alert.empty();
            $.ajax({
                url: ajax_url,
                beforeSend: function() {
                    alert.empty();
                },
                data: {
                    action: "check_username",
                    username: username,
                    _token: token,
                },
                dataType: "JSON",
                type: "POST",
                success: function(res) {
                    alert.empty();
                    if (res.status == "error") {
                        $('<div class="text-danger"></div>')
                            .html(
                                "Username already exist! Try another Username."
                            )
                            .appendTo(alert);
                        signup.attr("disabled", true);
                    } else {
                        $('<div style="color: green !important"></div>')
                            .html(
                                "Great! You'r Choose good username. please goahead"
                            )
                            .appendTo(alert);
                        signup.attr("disabled", false);
                    }
                },
            });
        } else {
            signup.attr("disabled", false);
        }
    } else {
        alert.empty();
    }
}
// for check email

$(".candidate-email-check").on("keyup", function(e) {
    var alert = $(".candidate-email-error");
    var signup = $(".sign-up-candidate");
    var email = $(this).val();
    emailCheck(alert, email, signup);
});
$(".employee-email-check").on("keyup", function(e) {
    var alert = $(".employee-email-error");
    var signup = $(".sign-up-employee");
    var email = $(this).val();
    emailCheck(alert, email, signup);
});

function emailCheck(alert, email, signup) {
    alert.empty();
    if (email != "") {
        if (email.trim().length >= 5) {
            let regex = "";
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (re.test(String(email).toLowerCase())) {
                alert.empty();
                $.ajax({
                    url: ajax_url,
                    beforeSend: function() {
                        alert.empty();
                    },
                    data: {
                        action: "check_email",
                        email: email,
                        _token: token,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(res) {
                        alert.empty();
                        if (res.status == "error") {
                            $('<div class="text-danger"></div>')
                                .html("Email already exist! Try another Email.")
                                .appendTo(alert);
                            signup.attr("disabled", true);
                        } else {
                            $('<div style="color: green !important"></div>')
                                .html("Great! You'r Choose a unique email")
                                .appendTo(alert);
                            signup.attr("disabled", false);
                        }
                    },
                });
            }
        } else {
            signup.attr("disabled", false);
        }
    } else {
        alert.empty();
    }
}

/**salary negotiable */
$(".salary_negotiable").change(function() {
    if ($(this).prop("checked")) {
        $(".expected_salary").attr("disabled", true);
        $(".expected_salary").attr("required", false);
    } else {
        $(".expected_salary").attr("disabled", false);
        $(".expected_salary").attr("required", true);
    }
});

$(".submited").click(function(e) {
    let alert = $(".error-length");
    alert.empty();
    var editorContent = tinyMCE.activeEditor.getContent();
    if (editorContent.length > 4 && editorContent.length <= 11) {
        e.preventDefault();
        $(".textarea .filled").hide();
        $('<span class="text-danger"></span>')
            .html("Length must be greater than 5 characters")
            .appendTo(alert);
    } else {
        alert.empty();
    }
});