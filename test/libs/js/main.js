//render frontend
const ROOT = "http://test.local";
const pg_render = '/libs/js/render.js';
const pg_loader = '/libs/js/live.js';

require([
    pg_loader,
    pg_render
], function() {
    $(document).ready(function() {

    });
});

function openCategory(e) {
    window.location.href = ROOT + "/products/list?category=" + e;
}