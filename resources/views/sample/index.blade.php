<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sample (テストサンプル)</title>
</head>
<body>
    <h1>sample (テスト用)</h1>
    <p>{{ $name }}</p>
    <?php
    $javaScriptCode = "<script>alert('xss')</script>";
    ?>
    <p>{{ $javaScriptCode }}</p>    <!-- htmlspecialchars関数を通して出力  ---------->
    <p>{!! $javaScriptCode !!}</p>  <!-- エスケープせずに出力 ---------->
    <div>
  {{--
    @foreach($tweets as $tweet)
        <p>{{ $tweet->content }}</p>
    @endforeach
   --}}
    </div>
</body>
</html>
