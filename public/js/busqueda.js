function myFunction() {
    var input, filter, section, div, h1, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    section = document.getElementById("mySection");
    div = section.getElementsByTagName("div");
    for (i = 0; i < div.length; i++) {
      h1 = div[i].getElementsByTagName("h1")[0];
      if (h1) {
        if (h1.innerHTML.toUpperCase().indexOf(filter) > -1) {
          div[i].style.display = "";
        } else {
          div[i].style.display = "none";
        }
      }
    }
  }