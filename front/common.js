function serverRequest(data) {
  var xhr = new XMLHttpRequest();
  url = "https://web.njit.edu/~ybp7/CS490/middle.php";
  xhr.open("post", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  // send the collected data as JSON
  xhr.send(data);
  //console.log("sent data: ");
  //console.log(data);

  xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
        //console.log("returned data: ");
        //console.log(xhr.responseText);
        return xhr.responseText;
    }
  };
}

function loadHTML(divID, url) {
  var xhr= new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.onreadystatechange= function() {
      if (this.readyState!==4) return;
      if (this.status!==200) return; // or whatever error handling you want
      document.getElementById(divID).innerHTML= this.responseText;
  };
  xhr.send();
}
