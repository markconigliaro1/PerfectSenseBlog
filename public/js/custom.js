function toggleCommentForm(postID) {
    var x = document.getElementById("comment-form-" + postID);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}