var currentTab = 'general';
var iFrameID = document.getElementById('content-frame');

function iframeLoaded() {
	iFrameID = document.getElementById('content-frame');
    if (iFrameID) {
        iFrameID.height = "";
        iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
    }
}

function init() {
    currentTab = 'general';
    iFrameID.setAttribute('src', '/patient_general.html');
    iframeLoaded();
}

function onTabChange(selectedTab) {
    if (selectedTab !== currentTab) {
        document.getElementById(selectedTab).classList.add('active-tab');
        document.getElementById(currentTab).classList.remove('active-tab');
        document.getElementById(selectedTab).blur();
        switch (selectedTab) {
            case 'general':
                currentTab = 'general';
                iFrameID.setAttribute('src', '/patient_general.html');
                break;
            case 'history':
                currentTab = 'history';
                iFrameID.setAttribute('src', '/patient_history.html');
                break;
            case 'appointments':
                currentTab = 'appointments';
                iFrameID.setAttribute('src', '/patient_appointment.html');
                break;
            case 'visits':
                currentTab = 'visits';
                iFrameID.setAttribute('src', '/patient_visits.html');
                break;
            case 'medications':
                currentTab = 'medications';
                iFrameID.setAttribute('src', '/patient_medication.html');
                break;
        }
    }
}

init();