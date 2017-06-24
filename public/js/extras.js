
	//Offline status check
    $(function(){
        var 
        $online  = $('.online'),
        $offline = $('.offline');

        Offline.on('confirmed-down', function() {
            $online.fadeOut(function(){
                $offline.fadeIn();
            });
        });

        Offline.on('confirmed-up', function() {
            $offline.fadeOut(function(){
                $online.fadeIn();
            });
        });

        Offline.check();

    });
	//Redirect to home when session expires
	$(function() {
    	// Set idle time
    	$( document ).idleTimer(7200000);
    });

	$(function() {
       $( document ).on( "idle.idleTimer", function(event, elem, obj){
           window.location.href = "/"
       });
   });

	//datepicker script
	$('#sandbox-container .input-group.date').datepicker({
		startView: 3,
		daysOfWeekDisabled: "0"
    });
	//Introducting a block history when clicking back button
	(function (global) {

        if(typeof (global) === "undefined") {
            throw new Error("window is undefined");
        }

        var _hash = "!";
        var noBackPlease = function () {
            global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {
        noBackPlease();
        $('.username').val("");
        $('.password').val("");

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };
    }
})(window);

$('.schedule').datepicker();

$('.schedule').datepicker({
    language: 'en',
    minDate: new Date() 
});
$('#search-modal').on('shown.bs.modal', function() {
  $('.search-input').focus();
});

$('.search-input').focus();
$('.focus').focus();

$("input[name='search']").focus();
    //Focus on input when prepare modal open
    $('#prepareModal').on('shown.bs.modal', function () {
        $("input[name='quantityDispensed']").focus();
    });  

    $('#search-dispensation').on('shown.bs.modal', function () {
        $('.focus-input').focus();
    }); 

    $('.search').on('shown.bs.modal', function () {
        $('.search').focus();
    }); 

    $('.modal').on('shown.bs.modal', function () {
        $('.focus').focus();
    });
    //when loosing focus on no of days input add days to start date and show end date in input
    $("input[name='date_birth']").focusout(function() {
        focus++;
        
        $("input[name='estimated_age']").prop('disabled', true);  
    });
    
    $(function() {
        $('.scroll').jscroll({
            autoTrigger: true,
            nextSelector: '.pagination li.active + li a',  
            contentSelector: 'div.scroll',
            callback: function() {
                $('ul.pagination:visible:first').hide();
            }
        });
    });

    $(".nav ul li").on("click", function(){
     $(".nav ul li a li").find(".active").removeClass("active");
     $(this).parent().addClass("active");
 });
