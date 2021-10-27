var button = document.getElementById("upvote"),
var loggedin = false;
 
count = 0;

if (loggedin)
  {
function myFunction() 
   {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
   }
  }
  
  else
  {
   
  button.onclick = function()
  {
  count += 1;
  button.innerHTML = "Upvote: " + count; 
  }
  };

   

