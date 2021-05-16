$(".nav-link").click(function () {
    if ($(this).attr("aria-controls") == "tab-3") {
        $("#new_ticket_button").show();
    } else if ($(this).attr("aria-controls") != "tab-3") {
        $("#new_ticket_button").hide();
    }
})

$('.owl-carousel').owlCarousel({
    items: 1,
    margin: 10,
    nav: false,
    dots: true,
    mouseDrag: false,
});

