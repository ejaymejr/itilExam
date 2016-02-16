$(function(){
    $("[data-load]").each(function(){
        $(this).load($(this).data("load"), function(){
        });
    });

    window.prettyPrint && prettyPrint();

    $(".history-back").on("click", function(e){
        e.preventDefault();
        history.back();
        return false;
    })
})


function headerPosition(){
    if ($(window).scrollTop() > $('header').height()) {
        $("header .navigation-bar")
            .addClass("fixed-top")
            .addClass(" shadow")
        ;
    } else {
        $("header .navigation-bar")
            .removeClass("fixed-top")
            .removeClass(" shadow")
        ;
    }
}

$(function() {
    if ($('nav > .side-menu').length > 0) {
        var side_menu = $('nav > .side-menu');
        var fixblock_pos = side_menu.position().top;
        $(window).scroll(function(){
            if ($(window).scrollTop() > fixblock_pos){
                side_menu.css({'position': 'fixed', 'top':'65px', 'z-index':'1000'});
            } else {
                side_menu.css({'position': 'static'});
            }
        })
    }
});

$(function(){
    setTimeout(function(){headerPosition();}, 100);
})

$(window).scroll(function(){
    headerPosition();
});

METRO_AUTO_REINIT = true;

function doAjax(event){
	$.ajaxSetup ({  
        cache: true  
    });
	var length = 0;
	var params = '';
	if (typeof  event.data.param != 'undefined'){
		var myarr = event.data.param.split(",");
		var length = myarr.length;
	}
	
	if (event.data.extraparams){
		params = event.data.extraparams + '&';
		
	}
	for(var x=0; x< length; x++){
		//console.log(myarr[x]);
		//if (x <> 0) { 
		//	params += '&'; 
		//	}
		var origText = $.trim(myarr[x]);
		var assigned=origText.indexOf("=");
		if (assigned > 0){
			params += $.trim(myarr[x] );
			params += '&';
		}else{
			var textvalue = '#' + $.trim(myarr[x]);
			var textval = encodeURI(($(textvalue)).val());   //jquery get Value from input text
			if (textvalue) {
				params += $.trim( myarr[x] ) +'='+ (textval);  //jquery make a url format ("customer=seagate&building=w2")
				params += '&';
			}

		}
	}
	
	//var ajax_load = '<div class="">Loading... <div class=\"loading\"></div></div>'; //this for the loader_orig.css
	//var ajax_load = '<div id=\"showloader\"></div>'; 

		
	var ajax_load = '<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div></div>';
	var loadUrl = event.data.loadUrl;
	$(event.data.update).html(ajax_load).load(loadUrl, params );
	//<script>$("body").addClass("loaded");</script>
	return false;
} 

function showhideDIV(id) {
    var e = document.getElementById(id);
    if (e.style.visibility == 'visible') e.style.visibility = 'hidden';
    else e.style.visibility = 'visible';
}