
//Firefox retains the state of forms after page refresh, including radio buttons. Without form reset, if the existing user radio button is checked and the page is refreshed, the form after refresh will show the fields for new user (with "existing user" still checked). Form refresh fixes this.
//
//document.form.reset();
//$("div#form").hide();

$("input[name='has_account']").change(function(){
    //show the appropriate fields for new and existing users
    $(".form-group:has(input[name='name']), .form-group:has(input[name='email']), .form-group:has(input[name='guid/email']), .form-group:has(input[name='guid'])").toggleClass("show");
    $(".form-group:has(input[name='name']), .form-group:has(input[name='email']), .form-group:has(input[name='guid/email']), .form-group:has(input[name='guid'])").toggleClass("hide");

    //toggle which fields are required
    //http://stackoverflow.com/questions/6617475/how-to-toggle-attribute-in-jquery
    $(".form-horizontal").find("input[name='name'], input[name='email'], input[name='guid/email']").prop("required", function(idx, oldProp){
        return !oldProp;
    });
});

$(function() {	//button event handlers
    $("#table_header").on('click', "#prev", function() {

        $("#table_content").find('.data').addClass('next_data').removeClass('data');
        $("#table_content").find('.prev_data').addClass('data').removeClass('prev_data');

        //change calendar title
        $.ajax({
            type : "POST",
            url : "../calendarHeader.php",
            dataType : "html",
            //async: false,
            data : {
                date: $("#date_wrapper").find("#date").text(),
                button: "prev"
            },
            success: function(result){
                //$("#date_wrapper").find("#date").text(result);
                $("#date_wrapper").html(result);

            }

        });

        //get new calendar
        $.ajax({
            type : "POST",
            url : "../calendar.php",
            dataType : "html",
            //async: false,
            data : {
                date: $("#date_wrapper").find("#date").text(),
                button : "prev"
            },

            success : function(result) {//update table


                var $r = result.split("|"); //separate html and JQuery
                $("#table_content tr:first").before($r[0]);
                jQuery.globalEval($r[1]);

            }


        });
    });

    $("#table_header").on('click', "#next", function() {
       // var r = $.Deferred();

        $("#table_content").find('.data').addClass('prev_data').removeClass('data');
        $("#table_content").find('.next_data').addClass('data').removeClass('next_data');

        //change calendar title
        $.ajax({
            type : "POST",
            url : "../calendarHeader.php",
            dataType : "html",
            //async: false,
            data : {
                date: $("#date_wrapper").find("#date").text(),
                button: "next"
            },
            success: function(result){
                //$("#date_wrapper").find("#date").text(result);
                $("#date_wrapper").html(result);


            }
        });

        $.ajax({
            type : "POST",
            url : '../calendar.php',
            dataType : "html",
            //async: false,
            data : {
                date: $("#date_wrapper").find("#date").text(),
                button : "next"
            },

            success : function(result) {//update table
                //move the buttons outside the table before it's contents get replaced
                //$("#next").detach().prependTo("#table_wrapper");
                //$("#prev").detach().prependTo("#table_wrapper");


                //var r = result.split("|"); //separate html and JQuery

                var $r = result.split("|"); //separate html and JQuery
                $("#table_content tr:last").after($r[0]);
                jQuery.globalEval($r[1]);

            }

        });
        //r.resolve();
    });
});

/*
 * moved to separate files
$("#timeslots").on('click','.timeslots',function(){
    $("#timeslots").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");
    $("div#form").show();
});
*/

$(".calendar").on('click','.data',function(){	//on click toggle background of selected day
    $("#table_content").find(".clicked").toggleClass("clicked");		//restore default background
    $(this).toggleClass("clicked");		//paint selected day's background
    $("div#form").hide();
    $.ajax({
        type: "POST",
        url: "timeslots.php",
        dataType: "html",
        data: {
            day: $(this).text(),
            date: $("#date_wrapper").find("#date").text()
        },
        success: function(result){
            $("#timeslots .slots").html(result);
        }
    });

});


$(".calendar").on('click', '.prev_data', function(){

    $("#table_content").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");
   // var r = $.Deferred();

    //r.resolve();

    $("#table_content").find('.data').addClass('next_data').removeClass('data');
    $("#table_content").find('.prev_data').addClass('data').removeClass('prev_data');

    //change calendar title
    $.ajax({
        type : "POST",
        url : "../calendarHeader.php",
        dataType : "html",
        //async: false,
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button: "prev"
        },
        success: function(result){
            //$("#date_wrapper").find("#date").text(result);
            $("#date_wrapper").html(result);
            $("#table_content").find(".clicked").toggleClass("clicked").trigger("click"); //must be called AFTER new date is returned, hence the repetition

        }

    });

    //get new calendar
    $.ajax({
        type : "POST",
        url : "../calendar.php",
        dataType : "html",
        //async: false,
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button : "prev"
        },

        success : function(result) {//update table


            var $r = result.split("|"); //separate html and JQuery
            $("#table_content tr:first").before($r[0]);
            jQuery.globalEval($r[1]);

        }


    });


});

$(".calendar").on('click', '.next_data', function(){
    $("#table_content").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");
    //$("#table_header").find("#next").trigger("click");

    $("#table_content").find('.data').addClass('prev_data').removeClass('data');
    $("#table_content").find('.next_data').addClass('data').removeClass('next_data');

    //change calendar title
    $.ajax({
        type : "POST",
        url : "../calendarHeader.php",
        dataType : "html",
        //async: false,
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button: "next"
        },
        success: function(result){
            //$("#date_wrapper").find("#date").text(result);
            $("#date_wrapper").html(result);
            $("#table_content").find(".clicked").toggleClass("clicked").trigger("click");
            // $(".clicked").trigger("click");


        }
    });

    $.ajax({
        type : "POST",
        url : '../calendar.php',
        dataType : "html",
        //async: false,
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button : "next"
        },

        success : function(result) {//update table

            var $r = result.split("|"); //separate html and JQuery
            $("#table_content tr:last").after($r[0]);
            jQuery.globalEval($r[1]);

        }

    });

});

$(".calendar").on('click', '.weekNum', function(){
    $("#table_content").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");

    $(this).siblings().toggleClass("clicked"); //paint whole week's background
    $("div#form").hide();
    $.ajax({
        type: "POST",
        url: "timeslots.php",
        dataType: "html",
        data:{
            week: $(this).text(),
            date: $("#date_wrapper").find("#date").text()

        },
        success: function(result){
            $("#timeslots .slots").html(result);
        }
    });
});

$("#today").on('onLoad',function(){
    $(this).toggleClass("clicked");		//paint selected day's background
    $("div#form").hide();
    $.ajax({
        type: "POST",
        url: "timeslots.php",
        dataType: "html",
        data: {
            day: $(this).text(),
            date: $("#date_wrapper").find("#date").text()
        },
        success: function(result){
            $("#timeslots .slots").html(result);
        }
    });
});


//$("#table_content").animate({
/*$(".calendar").animate({
    top: "-=100px"
},500);*/

$("#today").trigger("onLoad"); //when the page ends loading today's day is selected automatically




/*
$("#timeslots").on("click", ".delete", function(evt){
    //console.log("delete clicked");
    console.log($(this).parent().siblings().find(".id").text());

});
*/


