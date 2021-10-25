var button = document.getElementById("upvote"),
    count = 0;
button.onclick = function() {
    count += 1;
    button.innerHTML = "Upvote: " + count;
    setTimeout(onclick, 10);
    
};
