
    $(".hamburgerIcon").on("click", function () {
        // $(".secondaryNav").toggle();
        // $(".hamburgerIcon").toggleClass("hide show");
        $("header").toggleClass("isFade");
        setTimeout(function () {
            $("header").toggleClass("hideNav");
        }, 250);
    });
    
    