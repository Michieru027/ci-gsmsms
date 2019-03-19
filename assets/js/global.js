wow = new WOW(
    {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    }
);
wow.init();

$(document).ready(function(){
    // $('#home_carousel, .carousel').carousel({interval: 2000,cycle:true});
});