//reload page after every js change
const pg_live = '/libs/js/live.js';

//render functions
const pg_render = '/libs/js/render.js';

//post ajax functions
const pg_post = '/libs/js/post.js';

//post ajax functions
const pg_metaFunctions = '/libs/js/metaFunctions.js';

//constants
const pg_contants = '/libs/js/constants.js';

//product functions
const pg_products = '/libs/js/product.js';

//product functions
const form_async = '/libs/js/filehandler.js';

//onetime functions
const pg_otf = '/libs/js/otf.js';



require([
    pg_contants,
    pg_render,
    pg_metaFunctions,
    pg_post,
    pg_products,
    pg_otf,
    form_async,
    pg_live
], function() {
    $(document).ready(function() {
        var elem = $("#overlaymain");
        var open = elem.data("visible");

        if (open) {
            toggle_overlay();
        }

    });
});