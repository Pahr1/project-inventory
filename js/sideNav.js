document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, Option);
});

$(document).ready(function(){
    $('.sidenav').sidenav();
});