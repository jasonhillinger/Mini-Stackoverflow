function editProfile(){
    document.getElementById("aboutMe").style.display = "none";
    document.getElementById("aboutText").style.display = "initial";
    document.getElementById("usernameText").style.display = "initial";
    document.getElementById("username").hidden = true;
    document.getElementById("editButton").style.display = "none";
    document.getElementById("submitButton").style.display = "initial";
    document.getElementById("editImage").hidden = false;
    let upload = document.getElementById("newPic");
    upload.addEventListener('change', (event) => {
        let image = document.getElementById("profilePic");
        image.src = URL.createObjectURL(event.target.files[0]);
    });
}



