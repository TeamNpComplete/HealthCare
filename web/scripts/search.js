

$(document).ready(function () {

    // var value = $('#filter').val();
    // console.log("JavaScript" + value);
    // createCookie("search_param", value, "1");
  

    var res;
    var arr = new Array();
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
      console.log(this.readyState); console.log(this.status);

      if (this.readyState == 4 && this.status == 200) {
        var str = this.responseText;
        console.log(str);
        arr = $.parseJSON(str);
        console.log(arr);
        console.log(typeof arr)
        autocomplete(document.getElementById("myInput"), arr);
      }
    };

    xhttp.open("GET", "doctor_search.php", true);
    xhttp.send();

 
});

// function createCookie(name, value, days) { 
//   var expires; 
    
//   if (days) { 
//       var date = new Date(); 
//       date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
//       expires = "; expires=" + date.toGMTString(); 
//   } 
//   else { 
//       expires = ""; 
//   } 
    
//   document.cookie = escape(name) + "=" +  
//       escape(value) + expires + "; path=/"; 
// } 


function autocomplete(inp, arr) {

  var currentFocus;
  console.log(inp);
  console.log("array " + arr);
  inp.addEventListener("input", function (e) {

    var a, b, i, val = this.value;

    closeAllLists();

    if (!val) { return false; }
    currentFocus = -1;
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    this.parentNode.appendChild(a);

    for (i = 0; i < arr.length; i++) {
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

        b = document.createElement("DIV");
        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].substr(val.length);
        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";

        b.addEventListener("click", function (e) {
          inp.value = this.getElementsByTagName("input")[0].value;
          iFrameID.setAttribute('src', 'get_doctor.php?search_val=' + inp.value);
          closeAllLists();
        });

        a.appendChild(b);
      }
    }
  });

  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");

    if (e.keyCode == 40) {
      currentFocus++;
      addActive(x);
    } else if (e.keyCode == 38) {
      currentFocus--;
      addActive(x);
    } else if (e.keyCode == 13) {
      e.preventDefault();
      if (currentFocus > -1) {

        if (x) x[currentFocus].click();
      }
    }
  });

  function addActive(x) {

    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);

    x[currentFocus].classList.add("autocomplete-active");
  }

  function removeActive(x) {

    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }

  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}
//var countries = ["Dr Gautam Nahar","Dr Ketaki Gokhlae","Dr Aditya Gunjal","Dr Harshal Hiwale","Dr Yatindra Jain","Dr Chinmay Joshi","Dr Ram Joshi","Dr Kaustubh Jinarpure","Dr Omkar Sawnant","Dr Snehal Khandve","Dr Yash Kothadiya","Dr Sharv Kulkarni","Dr Shreya Labba"];
