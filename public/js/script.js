// required to get $orange variable
@import "functions";
@import "variables";

$primary: $orange; // set the $primary variable

// merge with existing $theme-colors map
$theme - colors: map - merge($theme - colors, (
    "primary": $primary
));

// set changes
@import "bootstrap";

$(".hamburgerIcon").on("click", function () {
    // $(".secondaryNav").toggle();
    // $(".hamburgerIcon").toggleClass("hide show");
    $("header").toggleClass("isFade");
    setTimeout(function () {
        $("header").toggleClass("hideNav");
    }, 250);
});

