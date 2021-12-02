const onClick = (event) => { //Function that will trigger if user clicks on any star (best answer icon) on page
    if (event.target.nodeName === 'path') {
        let OP = 0;
        let answerID = event.target.id.slice(4);
        $.ajax({ //check if user is the original poster of the question
            type: "POST",
            data: "answerID=" + answerID,
            url: "checkOP.php",
            async: false,
            success: function(msg) {
                if (msg.status == "notOP") {
                    alert("You must be the user who asked the question to choose the best answer");
                } else if (msg.status == "OP") {
                    OP = true;
                    //alert("You are the OP");
                }
            }
        });
        if (OP) { //if user is the original poster of the question
            console.log(answerID);
            let best = 0; //if best is 0, user is unmarking as best, if best=1 user is marking as best
            if (event.target.getAttribute("fill") == "gold") {
                //console.log("current fill="+event.target.getAttribute("fill"));
                best = 0;
            } else {
                //console.log("current fill="+event.target.getAttribute("fill"));
                best = 1;
            }
            console.log("best=" + best);
            $.ajax({ //Send the chosen best Answer answerID to POST to bestAns.php
                type: "POST",
                data: "answerID=" + answerID + "&best=" + best,
                url: "bestAns.php",
                async: false,
                success: function(msg) {
                    if (msg.success == "true" && best == 0) {
                        document.getElementById(event.target.id)
                            .setAttribute("fill", "grey");
                    } else if (msg.success == "true") {
                        document.getElementById(event.target.id)
                            .setAttribute("fill", "gold");
                    }
                    alert(msg.status);
                    console.log(msg.success);
                }

            });
        }
    }
}
window.addEventListener('click', onClick);


$(function() {
    $(".increment")
        .click(function() {

            let id = $("~ .count", this)
                .attr("id");
            let item = "";
            let questionID = "";
            let answerID = "";
            if (id.slice(0, 6) == "answer") {
                item = "answer";
                answerID = id.slice(6);
                console.log(id.slice(6));
            } else {
                item = "question";
                questionID = id;
                console.log(questionID);
            }
            let count = parseInt(document.getElementById(id)
                .innerHTML);
            let vote = "";

            $.ajax({ //check if user is signed in
                type: "POST",
                data: "user",
                url: "signedIn.php",
                async: false,
                success: function(msg) {
                    if (msg.status == "notSignedIn") {
                        alert("You must be signed in to vote");
                    } else if (msg.status == "signedIn") {
                        signedIn = true;
                        //alert("You are signed in");
                    }
                }
            });

            if (!signedIn) {
                alert("You must be signed in to vote");
                return false;
            }

            if (($(this)
                .hasClass("up"))) {
                // count ++;
                // document.getElementById(questionID).innerHTML=count.toString();
                vote = "up";
            } else if (($(this)
                .hasClass("down"))) {
                // count--;
                // document.getElementById(questionID).innerHTML=count.toString();
                vote = "down";
            }

            $.ajax({ //Send the current vote count and questionID to POST

                type: "POST",
                data: "questionID=" + questionID + "&answerID=" + answerID + "&vote=" + vote + "&item=" + item,
                url: "upVote.php",
                async: false,
                success: function(msg) {
                    if (msg.status == "success") {
                        if (vote == "up") {
                            count++;
                            document.getElementById(id)
                                .innerHTML = count.toString();
                        } else {
                            count--;
                            document.getElementById(id)
                                .innerHTML = count.toString();
                        }
                    } else if (msg.status == "failed") {
                        //alert("You can only vote once");
                    }
                }
            });

            $(this)
                .parent()
                .addClass("bump");

            setInterval(function() {
                $(this)
                    .parent()
                    .removeClass("bump");
            }, 400);
        });
});