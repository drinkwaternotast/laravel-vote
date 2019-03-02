<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Description -->
        <meta name="description" content="コスプレイヤーのための投票式画像対決サイト。好きなコスプレイヤーをキミの1票で応援しよう！ランキング上位のコスプレイヤーはサイトのTOPを飾れるかも！？人気者になって多くのフォロワーを獲得しちゃおう！">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (Agent::isMobile())
            <link rel='stylesheet' type='text/css' href="{{ mix('css/app_sp.css') }}">
        @elseif (Agent::isDesktop())
            <link rel='stylesheet' type='text/css' href="{{ mix('css/app.css') }}">
        @endif
        <link rel='stylesheet' type='text/css' href="{{ mix('css/navigation.css') }}">
        <script>
            window.Laravel =  <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
        </script>
        <title>Cosplayers Market</title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110080728-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'UA-110080728-1');
        </script>
    </head>
    <body>
        <div id="root"></div>
    </body>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</html>


