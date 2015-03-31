//specific only to student's page
document.form_student.reset();
$("div#form").hide();

$("#timeslots").on('click','.timeslots',function(){
    $("#timeslots").find(".clicked").toggleClass("clicked");
    $(this).toggleClass("clicked");
    $("div#form").show();
});

$( "form[name='form_student']" ).on( "submit", function( event ) {
    event.preventDefault();
    console.log( $( this ).serialize() );
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