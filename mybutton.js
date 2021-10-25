var button = document.getElementById("upvote"),
    count = 0;
button.onclick = function() {
    setTimeout(function, 1);
    count += 1;
    button.innerHTML = "Upvote: " + count;
};
