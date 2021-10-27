var button = document.getElementById("upvote"),
var logged = new Boolean(false),
 
count = 0;
function myFunction() {
  if (logged)
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
   

