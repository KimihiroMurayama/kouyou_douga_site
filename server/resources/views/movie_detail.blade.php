  <link href="https://vjs.zencdn.net/7.8.2/video-js.css" rel="stylesheet" />



<h1>動画再生ページ</h1>

<video id="video" class="video-js vjs-default-skin vjs-big-play-centered" controls="" preload="auto" width="320" height="240">
</video>
<script src="//vjs.zencdn.net/7.8.2/video.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function() {
        var player = videojs('video');
        player.src({
            src: 'https://thejiroboy.com/sample_movie_hts.m3u8',
            type: 'application/x-mpegURL',
            withCredentials: true
        });
    });
</script>
