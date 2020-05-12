//metafunctions//filtermanagerslist
function rendermanagers() {
    var elem = getbyid("rendermng");
    var jelem = $(elem);
    var adding = "<tr><td>Mwaura</td><td>5</td><td>Ksh3</td><td>Payment Accepted</td></tr>";
    // var adding = "<tr><td>Mwaura</td><td>5</td><td>Ksh3</td><td>Payment Accepted</td></tr>"
    jelem.nextAll('tr').remove();
    jelem.after(adding);
}