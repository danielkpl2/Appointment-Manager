//specific only to staff's page
$(".calendar").on('click','.data',function() {
    $(".insert input[name='date']").val($("#date_wrapper").find("#date").attr("value")+'-'+$(this).html());

});

$("#timeslots").on('click','.timeslots',function(){
    $("#timeslots").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");

    //shows and hides the note on timeslot click
    var note = $(this).next().filter(function(){return $(this).hasClass("note") == true});
    note.toggleClass("hide");

});

$("form[name='form_staff']").on("submit", function(event){
    event.preventDefault();
    //console.log( $( this ).serialize() );
    var d = $(this).serialize();
    var date = $(".insert input[name='date']").val(); //select date from the input field
    var day = date.substr(date.lastIndexOf('-')+1); //select day from the date

    var cell = $("#table_content .data").filter(function(){return $(this).text() === day});
    cell.addClass("available");


    //console.log();

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