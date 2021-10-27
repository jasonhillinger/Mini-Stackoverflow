var button = document.getElementById("upvote"),
let loggedin = 0;
 
count = 0;
function myFunction() {
  if (loggedin = 0)
  {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
  }
  
  else
  {
  button.onclick = function() {
  count += 1;
  button.innerHTML = "Upvote: " + count; 
  }
  }
};
   

