<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Letter Template</title>
    </head>
    <body>
        <div>
            @include('components.address', ['person' => $sender])
        </div>
        <div>
            @include('components.address', ['person' => $recipient])
        </div>
        <div>{!! $letter !!}</div>
    </body>
</html>
