
//$("#input-date").attr( 'readOnly' , 'true' );
var isAlertOpen = false;
$('#form-status').hide();

function openForm() {
    if(!isAlertOpen){
        $('#myForm').fadeIn();
        $('.container').css({opacity:0.2});
    }
}

function closeForm() {
    $('#myForm').fadeToggle();
    $('.container').css({opacity:1});
}

function getAppointment(){
    $('#myForm').fadeOut();
    var pattern = /^([1-9]|([012][0-9])|(3[01]))\/([0]{0,1}[1-9]|1[012])\/\d\d\d\d (20|21|22|23|[0-1]?\d):[0-5]?\d AM|PM$/;

    if(pattern.test($('#input-date').val())){
        var request = new XMLHttpRequest();

        request.onreadystatechange = () => {

            if(request.readyState == 4  && request.status == 200){
                console.log(request.responseText);
                $('#form-status').html(`Appointment Request set successfully !
                    </br><button class="close-btn" onclick="closeAlert()"><b>CANCEL</b></button>`);
                $('#form-status').addClass('success');
                $('#form-status').removeClass('failure');
                $('.close-btn').addClass('success-btn');
                $('.close-btn').removeClass('failure-btn');
            } else if(request.readyState == 4 && request.status != 200) {
                console.log(request.response);
                $('#form-status').html(`Internal Server error !
                    </br><button class="close-btn" onclick="closeAlert()"><b>CANCEL</b></button>`);
                $('#form-status').addClass('failure');
                $('#form-status').removeClass('success');
                $('.close-btn').addClass('failure-btn');
                $('.close-btn').removeClass('success-btn');
            }
        }
        $('#form-status').html(`<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span></div>`);
        request.open('POST','get_appointment.php', true);
        request.setRequestHeader('content-type', 'application/json');
        request.send(JSON.stringify({
            doctor_id:doctor_id,
            date: $('#input-date').val()
        }));

    } else {
        $('#form-status').html(`Invalid Date Time Format !
            </br>
            <button class="close-btn" onclick="closeAlert()"><b>CANCEL</b></button>`);
        $('#form-status').addClass('failure');
        $('#form-status').removeClass('success');
        $('.close-btn').addClass('failure-btn');
        $('.close-btn').removeClass('success-btn');
    }
    $('#form-status').fadeIn();
    isAlertOpen = true;
}

function closeAlert(){
    $('#form-status').hide();
    $('.container').css({opacity:1});
    isAlertOpen = false;
}