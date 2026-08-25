$(document).ready(function() {
    var audio = $('#audio')[0];
    var playPauseBtn = $('#play-pause-btn');
    var playhead = $('#playhead');
    var timeline = $('#timeline');
    var currentTime = $('#current-time');
    var duration = $('#duration');

    audio.addEventListener('loadedmetadata', function() {
        duration.text(formatTime(audio.duration));
    });

    audio.addEventListener('timeupdate', function() {
        var timelineWidth = timeline.width() - playhead.width();
        var playPercent = timelineWidth * (audio.currentTime / audio.duration);
        playhead.css('margin-left', playPercent);
        currentTime.text(formatTime(audio.currentTime));
    });

    playPauseBtn.click(function() {
        if (audio.paused) {
            audio.play();
            playPauseBtn.html('<i class="fa fa-pause"></i>');
        } else {
            audio.pause();
            playPauseBtn.html('<i class="fa fa-play"></i>');
        }
    });

    timeline.click(function(event) {
        var timelineWidth = timeline.width() - playhead.width();
        var offset = event.offsetX;
        var percent = offset / timelineWidth;
        audio.currentTime = audio.duration * percent;
    });

    function formatTime(seconds) {
        var minutes = Math.floor(seconds / 60);
        var seconds = Math.floor(seconds % 60);
        return (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
    }
});