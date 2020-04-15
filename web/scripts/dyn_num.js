$(document).ready(function()
{
    $("#home_phone").click(function(){
        var radioValue = $("input[name='home']:checked").val();
        if(radioValue == "yes" ) {
            if($('#inp_home').contents().length == 0) {
                $("#inp_home").append("<label>Home:</label><br><input type='tel' name='home_no' class='input' placeholder='123-12345678' pattern='[0-9]{3}-[0-9]{8}' required ><br><br> ").fadeIn(3000);
            }
        }
        else{
            $("#inp_home").empty();
        }
    });

    $("#work_phone").click(function(){
        var radioValue = $("input[name='work']:checked").val();
        if(radioValue == "yes") {
            if($('#inp_work').contents().length == 0) {
                $("#inp_work").append("<label>Work:</label><br><input type='text' name='work_no' class='input' placeholder='123-12345678' pattern='([0-9]){3}(-)([0-9]){8}' required ><br><br>").fadeIn(3000);
            }
        }
        else{
            $("#inp_work").empty();
        }
    });
});
