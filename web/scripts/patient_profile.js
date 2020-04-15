function validateFields() {
    var x;
    if(document.getElementsByName("firstname")[0].value == "") {
        document.getElementsByName("firstname")[0].focus();
        alert("Firstname cannot be empty.");
        return false;
    }
    if(document.getElementsByName("lastname")[0].value == ""){
        document.getElementsByName("lastname")[0].focus();
        alert("Lastname cannot be empty.");
        return false;
    }
    if(document.getElementsByName("dob")[0].value == ""){
        document.getElementsByName("dob")[0].focus();
        alert("Date of Birth not selected.");
        return false;
    }
    x = document.getElementsByName("email")[0].value;
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*[(\.\w{2,3})]{1,2}$/;
    if(!regex.test(x)) {
    	alert("Enter valid email.");
        document.getElementsByName("email")[0].focus();
    	return false;
    }

    if(document.getElementsByName("addr1")[0].value == "") {
        document.getElementsByName("addr1")[0].focus();
        alert("Address 1 cannot be empty.");
        return false;
    }
    if(document.getElementsByName("addr2")[0].value == ""){
        document.getElementsByName("addr2")[0].focus();
        alert("Address 2 cannot be empty.");
        return false;
    }
    if(document.getElementsByName("city")[0].value == ""){
        document.getElementsByName("city")[0].focus();
        alert("City cannot be empty.");
        return false;
    }
    var st = document.getElementById("state_name");
    x = st.options[st.selectedIndex].value;
    if(x == ""){
        document.getElementById("state_name").focus();
        alert("State not selected.");
        return false;
    }
    x = document.getElementsByName("zip")[0].value;
    regex = /[0-9]{6}/;
    if(!regex.test(x)) {
        document.getElementsByName("zip")[0].focus();
        alert("Enter valid zip code.");
        return false;
    }
    
    regex = /[0-9]{10}/;
    if(!regex.test(document.getElementsByName("ph_no")[0].value)){
        alert("Enter valid phone number.");
        document.getElementsByName("ph_no")[0].focus();
        return false;
    }

    regex = /[0-9]{3}-[0-9]{8}/;
    if(!regex.test(document.getElementsByName("cl_no")[0].value)){
        alert("Enter valid phone number.");
        document.getElementsByName("ph_no")[0].focus();
        return false;
    }
    /*regex = /[0-9]{3}-[0-9]{8}/;
    if(!regex.test(document.cont_nos#inp_home.home_no.value)){
        alert("Enter valid home number.");
        document.cont_nos.home_no.focus();
        return false;
    }
    if(!regex.test(document.cont_nos.work_no.value)){
        alert("Enter valid work number.");
        document.cont_nos.work_no.focus();
        return false;
    }*/

    return true;
}
