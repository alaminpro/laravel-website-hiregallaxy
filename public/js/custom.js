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

    $(window.opera ? "html" : "html, body").animate(
        {
            scrollTop: 0
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
var alert = $(".username-error");
$(".username-check").on("keyup", function(e) {
    var username = $(this).val();
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
                    _token: token
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
                    } else {
                        $('<div style="color: green !important"></div>')
                            .html(
                                "Great! You'r Choose good username. please goahead"
                            )
                            .appendTo(alert);
                    }
                }
            });
        } else {
            $('<div class="text-danger"></div>')
                .html("Please enter at least 5 charecter!")
                .appendTo(alert);
        }
    } else {
        alert.empty();
    }
});
// for check email
var alert = $(".email-error");
$(".email-check").on("keyup", function(e) {
    var email = $(this).val();
    alert.empty();
    if (email != "") {
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
                    _token: token
                },
                dataType: "JSON",
                type: "POST",
                success: function(res) {
                    alert.empty();
                    if (res.status == "error") {
                        $('<div class="text-danger"></div>')
                            .html("Email already exist! Try another Email.")
                            .appendTo(alert);
                    } else {
                        $('<div style="color: green !important"></div>')
                            .html("Great! You'r Choose a unique email")
                            .appendTo(alert);
                    }
                }
            });
        } else {
            $('<div class="text-danger"></div>')
                .html("Email should be valid!")
                .appendTo(alert);
        }
    } else {
        alert.empty();
    }
});
