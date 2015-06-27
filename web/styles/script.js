function dropdown(){
    $("<select />").appendTo("nav");

    
    $("<option />", {
       "selected": "selected",
       "value"   : "",
       "text"    : "Idź do..."
    }).appendTo("nav select");

    
    $("nav a").each(function() {
     var el = $(this);
     $("<option />", {
         "value"   : el.attr("href"),
         "text"    : el.text()
     }).appendTo("nav select");
    });
}

//google map
function initialize() {
    var mapCanvas = document.getElementById('map-canvas');

    var myLatlng = new google.maps.LatLng(50.073740, 19.908424);
    var mapOptions = {
        zoom: 15,
        center: myLatlng
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Uniwersytet Pedagogiczny im. Komisji Edukacji Narodowej, pok. 425'
    });
}


// function showes images in gallery
function gallery(){
    $('.galeria img').click(function(){
        $(this).addClass('seen');
    });
    $('body').click(function(){
        $watchedImg = $('.seen');
        $watchedImg.removeClass("seen");
    })
}

//SLIDER
function slide(){
    $('.dot').click(function(){
        var id = $(this).attr('id');
        $id = '#'+ id;
        $nextSlide = $('.slide'+$id);
        
        $currentSlide = $('article.active');
        
        var currentDot = $('.dot-active');

        if($nextSlide.length === 0){
            $nextSlide = $('.slide').first();
            nextDot = $('.dot').first();
        }

        $currentSlide.fadeOut(600).removeClass('active');
        $nextSlide.fadeIn(600).addClass('active');
        
        currentDot.removeClass('dot-active');
        $(this).addClass('dot-active');
    });

    setInterval(function () {
        $currentSlide = $('article.active');
        $nextSlide = $currentSlide.next();
        
        var currentDot = $('.dot-active');
        var nextDot = currentDot.next();

        if($nextSlide.length === 0){
            $nextSlide = $('article.slide').first();
            nextDot = $('.dot').first();
        }

        $currentSlide.fadeOut(400).removeClass('active');
        $nextSlide.fadeIn(2000).addClass('active');
        
        currentDot.removeClass('dot-active');
        nextDot.addClass('dot-active');
    }, 6000);
    // $('#dots').click(function(){
    //  $currentSlide = $('.active');
    //  $prevSlide = $currentSlide.prev();

    //  if($prevSlide.length === 0){
    //      $prevSlide = $('.slide').last();
    //  }

    //  $currentSlide.fadeOut(600).removeClass('active');
    //  $prevSlide.fadeIn(600).addClass('active');
    // });
};


// changes big photo in post page
function thumbs(){
    $big = $('img.thumbnail').first().attr('src');
    $('figure.active img').attr('src', $big);

    $('img.thumbnail').on(
        "click", function(){
            $currentThumb = $('figure.active');
            $next = $(this);
            
            $nextThumb = $next.attr('src');
            console.log($nextThumb);

            $('figure.active img').attr('src', $nextThumb);

            // $currentThumb.fadeOut(600).removeClass('active');
            // $nextThumb.fadeIn(600).addClass('active');
        }
    );
};



// description shows
function description(){
    $('.photo_desc').hover(
        function(){ //when mouse enter
            $desc = $(this).find('p');
            console.log($desc);
            $desc.removeClass("hidden");
            //$desc.addClass("shown");
        },
        function(){ //when mouse leaves
            $desc = $(this).find('p');
            console.log($desc);
            $desc.addClass("hidden");
        }
    );
};

//galeria
function lightbox (){
    $('.lightbox_trigger').click(function(e) {
        
        //prevent default action (hyperlink)
        e.preventDefault();
        
        //Get clicked link src
        var $image_href = $(this).attr("src");
        console.log($image_href);
        console.log($('#lightbox').length);

        var lightbox = 
            '<div id="lightbox" class="hidden">' +
                '<p>Zamknij</p>' +
                '<div id="photo">' +
                    '<img src="' + $image_href +'" />' +
                '</div>' +  
            '</div>';

        /*  
        If the lightbox window HTML already exists in document, 
        change the img src to to match the href of whatever link was clicked
        
        If the lightbox window HTML doesn't exists, create it and insert it.
        (This will only happen the first time around)
        */
        // if ( $('#lightbox').length == 0) {
            $('body').append(lightbox);
        // } else if ($('#lightbox').length > 0) {
            $('#photo').html('<img src="' + $image_href + '" />');

            $('#lightbox').fadeIn(300);
            
            var $maxheightvalue = $(window).height() - 20;
            $("#photo img").css({"max-height": $maxheightvalue + "px"}, {"margin-top": "1em"});
        // }

    });

};


$(document).resize(function(){
    dropdown();
});
$(document).ready(function(){
    dropdown();
    slide();
    thumbs();
    description();
    gallery();
    lightbox();
    
    google.maps.event.addDomListener(window, 'load', initialize);


    //showes chosen time on timeline
    $("ul.timeline li").click(function(){
        if( !$(this).hasClass("highlighted") ){
            var $className = $(this).attr("class");

            switch($className){
                case 'first':
                    var $element = $('section.first');
                break;
                case 'second':
                    var $element = $('section.second');
                    console.log("druga");
                break;
                case 'third':
                    var $element = $('section.third');
                break;
                case 'fourth':
                    var $element = $('section.fourth');
                break;
            };

            $('section.shown').fadeOut(1).removeClass("shown").addClass("hidden");
            $element.fadeIn(300).toggleClass("shown");
            $('li.highlighted').removeClass("highlighted");
            $(this).toggleClass("highlighted");
        }
    });


    //shows information about creators
    $('.old article img').hover(
        function(){ //when mouse enter
            $(this).next('p').removeClass("hidden").addClass("shown");
        },
        function(){ //when mouse leaves
            $(this).next('p').removeClass("shown").addClass("hidden");
        }
    );

    //Click anywhere on the page to get rid of lightbox window
    $(document).on( "click", "#lightbox p", function() {
        $("#lightbox").fadeOut(400);
    });

});