
var isAlertOpen = false;

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
    var pattern = /^([1-9]|([012][0-9])|(3[01]))\/([0]{0,1}[1-9]|1[012])\/\d\d\d\d (20|21|22|23|[0-1]?\d):[0-5]?\d AM|PM$/
    console.log($('#input-date').val());
    if(pattern.test($('#input-date').val())){
        $('#alert-text').html('Appointment Request is submitted successfully !');
        $('#form-status').addClass('success');
        $('#form-status').removeClass('failure');
        $('.close-btn').addClass('success-btn');
        $('.close-btn').removeClass('failure-btn');
    } else {
        $('#alert-text').html('Invalid Date-Time Format !');
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