<html>
<h1>TOPページ</h1>

<h2>内部リンク</h2>

<a href="/movie_detail/1234">動画詳細</a><br>
<a href="/login">ログイン</a><br>
<a href="/home">MyPgae</a><br>

<h2>おすすめ人気動画</h2>
@foreach( $recommended_movie_ids as $movie_id)
{{--    <a href="/movie_detail/1"><img src="https://thejiroboy.com/{{{ $movie_id }}}_hls.0000000.jpg" width="300" height="200"></a><br>--}}
    movide_id:{{{ $movie_id }}}のリンクを出す <br>
@endforeach
{{--<a href="/movie_detail/1"><img src="https://thejiroboy.com/1_hls.0000000.jpg" width="300" height="200"></a><br>--}}
{{--<a href="/movie_detail/2"><img src="https://thejiroboy.com/2_hls.0000000.jpg" width="300" height="200"></a><br>--}}
{{--<a href="/movie_detail/3"><img src="https://thejiroboy.com/3_hls.0000000.jpg" width="300" height="200"></a><br>--}}
</html>
