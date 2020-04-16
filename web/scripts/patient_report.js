var currentTab = 'general';
var iFrameID = document.getElementById('content-frame');
var patient_id = document.getElementById('patient-id').value;

function init() {
    currentTab = 'general';
    iFrameID.setAttribute('src', '/patient_general.php?patient_id=' + patient_id);
}

iFrameID.onload = function(){
    iFrameID.style.height = iFrameID.contentWindow.document.body.scrollHeight + 'px';
}

function onTabChange(selectedTab) {
    if (selectedTab !== currentTab) {

        document.getElementById(selectedTab).classList.add('active-tab');
        document.getElementById(currentTab).classList.remove('active-tab');
        document.getElementById(selectedTab).blur();

        switch (selectedTab) {
            case 'general':
                currentTab = 'general';
                iFrameID.setAttribute('src', '/patient_general.php?patient_id=' + patient_id);
                break;
            case 'history':
                currentTab = 'history';
                iFrameID.setAttribute('src', '/medical_history.php?patient_id=' + patient_id);
                break;
            case 'appointments':
                currentTab = 'appointments';
                iFrameID.setAttribute('src', '/patient_appointment.php?patient_id=' + patient_id);
                break;
            case 'medications':
                currentTab = 'medications';
                iFrameID.setAttribute('src', '/patient_medication.php?patient_id=' + patient_id);
                break;
        }
    }
}

init();