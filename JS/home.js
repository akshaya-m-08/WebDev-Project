$(document).ready(function(){

    $('.carousel').carousel();
    

    autoplay();
    

    function autoplay() {
        $('.carousel').carousel('next');
        setTimeout(autoplay, 4500);
    }
});
window.addEventListener('popstate', function(event) 
{
        window.history.back();
    
});
