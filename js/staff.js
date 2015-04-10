//Author: Daniel Kasprowicz
//specific to staff page

//on calendar cell click put the date stamp in the date input field
$(".calendar").on('click','.data',function() {
    $(".insert input[name='date']").val($("#date_wrapper").find("#date").attr("value")+'-'+$(this).html());

});

//highlight the clicked timeslot
$(".slots").on('click','.booked',function(){
    $(this).toggleClass("clicked");

    //shows and hides the note on timeslot click
    var note = $(this).next().filter(function(){return $(this).hasClass("note") == true});
    note.toggleClass("hide");

});

//highlight the day of the timeslot in the calendar on form submission,
//process the form, append the response in the response div (doesn't return anything on success, only if error occurs),
//trigger the click event on the calendar cell to refresh the timeslots table
$("form[name='form_staff']").on("submit", function(event){
    event.preventDefault();
    var d = $(this).serialize();
    var date = $(".insert input[name='date']").val(); //select date from the input field
    var day = date.substr(date.lastIndexOf('-')+1); //select day from the date
    //set the cell variable to the calendar cell that contains the day from the date input field
    var cell = $("#table_content .data").filter(function(){return $(this).text() === day});
    cell.addClass("available"); //add the 'available' class to that cell


    $.ajax({
        type: "post",
        url: "processform.php",
        dataType: "html",
        data: d,
        success: function(result){
            $("div.response").html(result);
            cell.trigger("click");

        }

    });

});

//delete buttons event handler
$(".slots").on("click", ".delete", function(){
    del(this.id);
});

//makes an ajax post call to the delete.php script which deletes the timeslot
function del(id){
    $.ajax({
        type: "post",
        url: "delete.php",
        dataType: "html",
        data:{
            id : id
        },

        success: function(result){
            $("#table_content").find(".clicked").first().trigger("click");
        }
    });
}

