//author: Daniel Kasprowicz
//specific only to student's page

document.form_student.reset(); //reset the form
$("div#form").hide(); //hide the form

//on click set the clicked state to the clicked timeslot and remove it from others and show the form
$("#timeslots").on('click','.timeslots',function(){
    $("#timeslots").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");
    $("div#form").show();
});

//process the form
$( "form[name='form_student']" ).on( "submit", function( event ) {
    event.preventDefault();
    var d = $(this).serialize();

    $.ajax({
        type: "post",
        url: "processform.php",
        dataType: "html",
        data: d + "&id=" + $("#timeslots").find(".clicked").find(".id").text(),
        success: function(result){
            $("div.response").html(result);
        }
    });

});