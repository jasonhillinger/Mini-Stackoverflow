var button = document.getElementById("upvote"),
var button = document.getElementById("myPopup"),
    count = 0;
popup.onclick = function() {
    count += 1;
    button.innerHTML = "Upvote: " + count;
};
