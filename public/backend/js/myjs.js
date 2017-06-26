$(document).ready(function (){
    $("#changpass").change(function (){
        if($(this).is(":checked"))
        {

            $(".password").removeAttr('disabled');
        }else{
            $(".password").attr('disabled',"");
        }
    });
});
$("div.alert").delay(3000).slideUp(1000);