jQuery(function($) {
             var slide = $(".s7_ftw-arrown"), cur = 0;
             setInterval(function(){
              $('.active',slide).removeClass('active');
              $('i',slide).eq((++cur)%15).addClass('active');
             }, 100 );
            });