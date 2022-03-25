<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SendData</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .form-group textarea{
            width: 386px;
            height: 77px;
        }
    </style>
</head>
<body class="antialiased">
<div class="container" style="margin-top: 30px; text-align: center">
    <p>Enter the text whose optimization level you want to measure.</p>
    <form method="POST">
        @csrf
        <input type="hidden" value="">
        <div class="form-group">
            <textarea required="required" id="w3review" name="contentText" rows="4" cols="50"></textarea>
        </div>
        <div class="btn">
            <button type="submit" class="btn btn-success">Send</button>
        </div>
    </form>
</div>
</body>
</html>
