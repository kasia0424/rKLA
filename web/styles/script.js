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
    // $('.galeria img').click(function(){
        // $(this).addClass('seen');
    // });
    // $('body').click(function(){
        // $watchedImg = $('.seen');
        // $watchedImg.removeClass("seen");
    // })
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
                    '<img class="view" src="' + $image_href +'" />' +
                '</div>' +
                '<img class="btn next" src="../media/layout/arrow-next.png" />' +
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
            //$('#photo .view').html('<img src="' + $image_href + '" />');
            $('#photo img').attr('src', $image_href);

            $('#lightbox').fadeIn(300);
            
            var $maxheightvalue = $(window).height() - 20;
            $("#photo img").css({"max-height": $maxheightvalue + "px"}, {"margin-top": "1em"});

            var $top = Math.ceil($(window).height() / 2.5);
            $("#lightbox .btn").css({"top": $top + "px"});
        // }

    });
// function galleryNext (){
     $(document).on( "click", "#lightbox img.next", function() {
        console.log("HI");
        $src = $('#photo img').attr('src');
        console.log($src);
        $currentPhoto = $('img[src="'+$src+'"]');//.find('img[src$="'+$src+'"]');
        console.log($currentPhoto);
        $currentPhoto.addClass('seen');

        $nextPhoto = $('div .seen').next();
        console.log($nextPhoto);

        if($nextPhoto.length === 0){
            $nextPhoto = $('.lightbox_trigger').first();
        }

        $image_href = $nextPhoto.attr('src');
        console.log(image_href);
        $('#photo img').attr('src', $image_href);
        // $currentPhoto.fadeOut(400).removeClass('active');
        // $nextPhoto.fadeIn(2000).addClass('active');
    });
};


// quiz http://code.tutsplus.com/tutorials/build-a-spiffy-quiz-engine--net-20185
function quiz (){
    var kroggy = { answers: [ 'b', 'd', 'a', 'c', 'a', 'd', 'b', 'a', 'd', 'a', 'd', 'c', 'a', 'b', 'd' ] }
    var progress = $('#progress'), 
        progressKeeper = $('#progressKeeper'), 
        notice = $("#notice"), 
        progressWidth = 630, 
        answers= kroggy.answers, 
        userAnswers = [], 
        questionLength= answers.length, 
        questionsStatus = $("#questionNumber") 
        questionsList = $(".question");
        
    notice.hide();
    progressKeeper.hide();

    function roundReloaded(num, dec) { 
        var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec); 
        return result; 
    }
    
    function judgeSkills(score) { 
        var returnString; 
            if (score==100) returnString = "Albus, is that you?"
            else if (score>90) returnString = "Outstanding, noble sir!"
            else if (score>70) returnString = "Exceeds expectations!"
            else if (score>50) returnString = "Acceptable. For a muggle."
            else if (score>35) returnString = "Well, that was poor."
            else if (score>20) returnString = "Dreadful!"
            else returnString = "For shame, troll!"
        return returnString;
    }
    
    function checkAnswers() { 
        var resultArr = [],  
        PD = 0,  
        WD = 0,  
        SW = 0,  
        Szt = 0,  
        Zw = 0,  
        IS = 0,  
        RM = 0,  
        LZ = 0,  
        Dyw = 0,  
        Zand = 0,  
        S = 0,  
        SN = 0; 
        // flag = false;
        var questAmount = userAnswers.length;

        for (i=0; i < questAmount; i++) {

            switch(userAnswers[i]){
                case 'q1a':
                    WD++; Szt++; PD++;
                    break;
                case 'q1b':
                    IS++; RM++; LZ++; Zand++;
                    break;
                case 'q1c':
                    Zw++; SW++; Dyw++; SN++; S++;
                    break;
                
                case 'q2a':
                    WD++; Szt++; PD++; RM++; Zw++;
                    break;
                case 'q2b':
                    IS++; SW++; Dyw++; S++;
                    break;
                case 'q1c':
                    LZ++; Zand++; SN++;
                    break;
                    
                case 'q3a':
                    Szt++; RM++; IS++; S++; Zand++;
                    break;
                case 'q3b':
                    Dyw++; WD++; LZ++;
                    break;
                case 'q3c':
                    Zw++; SW++; SN++; PD++;
                    break;
                
                case 'q4a':
                    Szt++; S++; Zand++; WD++; Zw++;
                    break;
                case 'q4b':
                    RM++; Dyw++; SW++; PD++;
                    break;
                case 'q4c':
                    IS++; LZ++; SN++;
                    break;
                
                case 'q5a':
                    Szt++; Zw++; PD++;
                    break;
                case 'q5b':
                    S++; WD++; Dyw++; SW++; IS++;
                    break;
                case 'q5c':
                    Zand++; RM++; LZ++; SN++;
                    break;
                
                case 'q6a':
                    Szt++; WD++; PD++; Dyw++;
                    break;
                case 'q6b':
                    Zw++; IS++; Zand++; RM++;
                    break;
                case 'q6c':
                    S++; SW++; LZ++; SN++;
                    break;
                
                case 'q7a':
                    WD++; Zw++; Zand++; RM++; S++;
                    break;
                case 'q7b':
                    Szt++; PD++; Dyw++; IS++; SN++;
                    break;
                case 'q7c':
                    SW++; LZ++;
                    break;
                
                case 'q8a':
                    Szt++; SN++;
                    break;
                case 'q8b':
                    IS++; Dyw++; LZ++; Zand++;
                    break;
                case 'q8c':
                    WD++; SW++; RM++;
                    break
                case 'q8d':
                    PD++; Zw++; S++;
                    break;
                
                case 'q9a':
                    Szt++; WD++; SW++; PD++; Zw++;
                    break;
                case 'q9b':
                    IS++; Dyw++;
                    break;
                case 'q9c':
                    LZ++; Zand++; RM++;
                    break;
                case 'q9d':
                    SN++; S++;
                    break;
                
                case 'q10a':
                    Szt++; WD++; SW++; PD++; Zw++;
                    break;
                case 'q10b':
                    Dyw++; Zand++;
                    break;
                case 'q10c':
                    IS++; LZ++; RM++;
                    break;
                case 'q10d':
                    SN++; S++;
                    break;
                
                case 'q11a':
                    SW++; Zw++; Dyw++; RM++;
                    break;
                case 'q11b':
                    WD++; Szt++; PD++; Zand++; IS++;
                    break;
                case 'q11c':
                    LZ++; S++; SN++;
                    break;
                
                case 'q12a':
                    SW++; Zw++; Dyw++; PD++;
                    break;
                case 'q12b':
                    RM++; WD++; Szt++; Zand++; IS++; LZ++;
                    break;
                case 'q12c':
                    S++; SN++;
                    break;
                
                case 'q13a':
                    PD++; WD++; Szt++; Zand++;
                    break;
                case 'q13b':
                    Zw++; Dyw++; IS++; LZ++;
                    break;
                case 'q13c':
                    RM++;
                    break;
                case 'q13d':
                    SW++; S++; SN++;
                    break;
                
                case 'q14a':
                    PD++; IS++;
                    break;
                case 'q14b':
                    Zw++; LZ++; SW++;
                    break;
                case 'q14c':
                    WD++; Zand++; Dyw++;
                    break;
                case 'q14d':
                    RM++;
                    break;
                case 'q14e':
                    Szt++; SN++; S++;
                    break;
            }
        }
        resultArr['PD'] = Math.round(PD/questAmount *100); 
        resultArr['WD'] = Math.round(WD/questAmount *100);
        resultArr['SW'] = Math.round(SW/questAmount *100);
        resultArr['Szt'] = Math.round(Szt/questAmount *100);
        resultArr['Zw'] = Math.round(Zw/questAmount *100);
        resultArr['IS'] = Math.round(IS/questAmount *100);
        resultArr['RM'] = Math.round(RM/questAmount *100);
        resultArr['LZ'] = Math.round(LZ/questAmount *100);
        resultArr['Dyw'] = Math.round(Dyw/questAmount *100);
        resultArr['Zand'] = Math.round(Zand/questAmount *100);
        resultArr['S'] = Math.round(S/questAmount *100);
        resultArr['SN'] = Math.round(SN/questAmount *100);

        return resultArr;
    }
    
    //navigation
    $('.btnStart').click(function(){ 
        progressKeeper.fadeIn(500);
        $(this).parents('.questionContainer').fadeOut(500, function(){ 
            $(this).next().fadeIn(500, function(){ progressKeeper.show(); }); 
        }); 
         return false;
    });
    
    $('.btnPrev').click(function(){ 
            notice.hide(); 
        $(this).parents('.questionContainer').fadeOut(500, function(){ 
            $(this).prev().fadeIn(500) 
        }); 
        progress.animate({ width: progress.width() - Math.round(progressWidth/questionLength), }, 500 ); 
             return false; 
    });
    $('.btnNext').click(function(){ 
        var tempCheck = $(this).parents('.questionContainer').find('input[type=radio]:checked'); 
        if (tempCheck.length == 0) { 
             notice.fadeIn(300);return false; 
        } 
             notice.hide(); 
        $(this).parents('.questionContainer').fadeOut(500, function(){ 
            $(this).next().fadeIn(500); 
        }); 
        progress.animate({ width: progress.width() + Math.round(progressWidth/questionLength), }, 500 ); 
             return false; 
    });

$('.btnShowResult').click(function(){ 
    var tempCheck = $(this).parents('.questionContainer').find('input[type=radio]:checked'); 
    if (tempCheck.length == 0) { 
        notice.fadeIn(300);
        return false; 
    } 
    var tempArr = $('input[type=radio]:checked');
    var i = 0;
    for (ii = tempArr.length; i < ii; i++) { 
        userAnswers.push(tempArr[i].getAttribute('id'));
    }
    console.log(userAnswers);

    var results = checkAnswers();
console.log(results);    
                  // resultSet = '', 
                  // trueCount = 0, 
                  // answerKey = ' Answers <br />', 
                  // score;
    // for (var i = 0, ii = results.length; i &lt; ii; i++){ 
        // if (results[i] == true) trueCount++; 
        // resultSet += '<div class="resultRow"> Question #' + (i + 1) + (results[i]== true ? "<div class='correct'><span>Correct</span></div>": "<div class='wrong'><span>Wrong</span></div>") + "</div>"; 
        // answerKey += (i+1) +" : "+ answers[i] +' &nbsp;  &nbsp;  &nbsp;   '; 
    // } 
    // score =  roundReloaded(trueCount / questionLength*100, 2);
    $('#Dyw button.quiz').text(results['Dyw']+'%');
    $('#IS button.quiz').text(results['IS']+'%');
    $('#LZ button.quiz').text(results['LZ']+'%');
    $('#PD button.quiz').text(results['PD']+'%');
    $('#RM button.quiz').text(results['RM']+'%');
    $('#S button.quiz').text(results['S']+'%');
    $('#SN button.quiz').text(results['SN']+'%');
    $('#SW button.quiz').text(results['SW']+'%');
    $('#Szt button.quiz').text(results['Szt']+'%');
    $('#WD button.quiz').text(results['WD']+'%');
    $('#Zand button.quiz').text(results['Zand']+'%');
    $('#Zw button.quiz').text(results['Zw']+'%');


//answerKey = "<div id='answer-key'>" + answerKey + "</div>"; 
// resultSet = '<h2 class="qTitle">' +judgeSkills(score) + ' You scored '+score+'%</h2>' + resultSet + answerKey; 
    // $('#resultKeeper').html(resultSet).show();
    progressKeeper.hide();
    notice.hide();
    $('#resultKeeper').show(); 
    $(this).parents('.questionContainer').fadeOut(500, function(){ 
        $(this).next().fadeIn(500); 
    }); 
    $('#results-container').fadeIn(500);
// return false;
    
    
// $("#main-quiz-holder input:radio").attr("checked", false);
// $('.answers li input').click(function() { 
    // $(this).parents('.answers').children('li').removeClass("selected"); 
    // $(this).parents('li').addClass('selected'); 
// });
});
};

//facebook
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s);
  js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


//underline current site
function menuUnderline (){
    var pathArray = window.location.pathname.split( '/' );
    var lastIndex = pathArray.length;
    if (lastIndex > 5){
        var site = pathArray[pathArray.length -2];
    } else {
        var site = pathArray[pathArray.length -1];
    }
    $('#'+site).css("background-color", "white");
    $('#'+site+'>a').css("color", "black");
}

$(document).resize(function(){
    dropdown();
});
$(document).ready(function(){
    menuUnderline();
    dropdown();
    slide();
    thumbs();
    description();
    gallery();
    lightbox();
    quiz();

    //google maps
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