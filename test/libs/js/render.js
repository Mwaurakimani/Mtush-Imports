function toggle_menu() {
    var elem = $(".menu_panel");
    var elem2 = elem.find(".menu_items");
    var visibility = elem.css("display");

    //rotate
    var all_bars = $(".menu_burger ul li");
    var bar1 = all_bars[0];
    var bar2 = all_bars[1];
    var bar3 = all_bars[2];


    if (visibility == "block") {
        animate_close();
        elem2.css({ "left": "-100%" });
        elem.delay(400).fadeOut(100, "swing", function() {

        });
    } else {
        animate_open();
        elem.fadeIn(100, "swing", function() {
            elem2.css({ "left": "0%" });
        });
    }

    function animate_open() {
        $(bar1).css({
            "top": "13px",
            "left": "0px",
            "transform": "rotate(45deg)"
        });
        $(bar2).css({
            "opacity": "0",
        });
        $(bar3).css({
            "top": "-14px",
            "left": "0px",
            "transform": "rotate(-45deg)"
        });
    }

    function animate_close() {
        $(bar1).css({
            "top": "1px",
            "transform": "rotate(0deg)"
        });
        $(bar2).css({
            "opacity": "1",
        });
        $(bar3).css({
            "top": "2px",
            "transform": "rotate(0deg)"
        });
    }
}

function render_category(uuid) {
    var id = uuid;
    console.log(id);

}