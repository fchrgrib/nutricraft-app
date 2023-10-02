function toggleVideo(card) {
    var content = card.querySelector('.video-content');
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight =  "50vw";
    }
}