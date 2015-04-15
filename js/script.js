//author: Daniel Kasprowicz
//specific to both staff and student pages


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

//button event handlers
$("#table_header").on('click', "#prev", function() {

    //change the current month day cells to next month date cells
    $("#table_content").find('.data').addClass('next_data').removeClass('data');
    //change the previous month date cells to current month date cells
    $("#table_content").find('.prev_data').addClass('data').removeClass('prev_data');

    //change calendar title
    $.ajax({
        type : "POST",
        url : "../calendarHeader.php",
        dataType : "html",
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button: "prev"
        },
        success: function(result){
            $("#date_wrapper").html(result); //update the date header
        }
    });

    //get new calendar
    $.ajax({
        type : "POST",
        url : "../calendar.php",
        dataType : "html",
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button : "prev"
        },

        success : function(result) {//update table
            var $r = result.split("|"); //separate html and JQuery
            $("#table_content tr:first").before($r[0]); //append the html result
            jQuery.globalEval($r[1]); //execute the JQuery script
        }
    });
});

$("#table_header").on('click', "#next", function() {

    //change the current month day cells to previous month date cells
    $("#table_content").find('.data').addClass('prev_data').removeClass('data');
    //change the next month date cells to current month date cells
    $("#table_content").find('.next_data').addClass('data').removeClass('next_data');

    //change calendar title
    $.ajax({
        type : "POST",
        url : "../calendarHeader.php",
        dataType : "html",
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button: "next"
        },
        success: function(result){
            $("#date_wrapper").html(result); //update the date header
        }
    });

    $.ajax({
        type : "POST",
        url : '../calendar.php',
        dataType : "html",
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button : "next"
        },

        success : function(result) {//update table
            var $r = result.split("|"); //separate html and JQuery
            $("#table_content tr:last").after($r[0]); //append the html result
            jQuery.globalEval($r[1]); //execute the JQuery script
        }
    });
});

//on current month calendar cell click, change its state to clicked and remove clicked state from other cells,
//hide the form, make an ajax post call to the timeslots script and update the timeslots table
$(".calendar").on('click','.data',function(){	//on click toggle background of selected day
    $("#table_content").find(".clicked").toggleClass("clicked"); //restore default background
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

//On previous month calendar cell click, switch the calendar to previous month and update the timeslots table
//This is achieved in 2 steps: the calendar is switched to prev month and then the calendar table cell click is triggered
//The prev month button event trigger can't be used for this as the second ajax call (to retrieve timeslots table) uses
//the date header which needs to be updated BEFORE the timeslot retrieval call. Furthermore this second ajax call tends
//to fire before the new date header is updated. This can only be achieved by triggering
//the calendar cell click AFTER the date header is updated, in the success function, hence the code repetition from button event handler.
$(".calendar").on('click', '.prev_data', function(){

    $("#table_content").find(".clicked").toggleClass("clicked"); //remove clicked state from other cells
    //set clicked state to this cell, only used as a marker for the second selector in the success function
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
            $("#date_wrapper").html(result);
            //triggers a click event on the previous month cell
            //must be called AFTER new date is returned as the date header needs to be updated before the timeslot table update,
            //hence the repetition of code
            //also the clicked cell state is disabled before triggering the cell click
            $("#table_content").find(".clicked").toggleClass("clicked").trigger("click");
        }
    });

    //get new calendar
    $.ajax({
        type : "POST",
        url : "../calendar.php",
        dataType : "html",
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

//On next month calendar cell click, switch the calendar to next month and update the timeslots table
//This is achieved in 2 steps: the calendar is switched to next month and then the calendar table cell click is triggered
//The next month button event trigger can't be used for this as the second ajax call (to retrieve timeslots table) uses
//the date header which needs to be updated BEFORE the timeslot retrieval call. Furthermore this second ajax call tends
//to fire before the new date header is updated. This can only be achieved by triggering
//the calendar cell click AFTER the date header is updated, in the success function, hence the code repetition from button event handler.
$(".calendar").on('click', '.next_data', function(){
    $("#table_content").find(".clicked").toggleClass("clicked"); //remove clicked state from other cells
    //set clicked state to this cell, only used as a marker for the second selector in the success function
    $(this).toggleClass("clicked");


    $("#table_content").find('.data').addClass('prev_data').removeClass('data');
    $("#table_content").find('.next_data').addClass('data').removeClass('next_data');

    //change calendar title
    $.ajax({
        type : "POST",
        url : "../calendarHeader.php",
        dataType : "html",
        data : {
            date: $("#date_wrapper").find("#date").text(),
            button: "next"
        },
        success: function(result){
            $("#date_wrapper").html(result);
            //triggers a click event on the previous month cell
            //must be called AFTER new date is returned as the date header needs to be updated before the timeslot table update,
            //hence the repetition of code
            //also the clicked cell state is disabled before triggering the cell click
            $("#table_content").find(".clicked").toggleClass("clicked").trigger("click");
        }
    });

    $.ajax({
        type : "POST",
        url : '../calendar.php',
        dataType : "html",
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

//on week number click set the clicked state to the whole week and update the timeslots table with timeslots for the whole week
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

//set clicked state to today's calendar cell and retrieve timeslots
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

$("#today").trigger("onLoad"); //when the page ends loading today's day is selected automatically