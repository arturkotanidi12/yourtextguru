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
            width: 544px;
            height: 98px;
        }
        .selectpicker{
            width: 544px;
            height: 50px;
        }
    </style>
</head>
<body class="antialiased">
    <div class="container" style="margin-top: 30px; text-align: center">
        <p>Entrez le mot-clé de votre texte" instead of</p>
        <form action="{{route('get-statistic')}}" method="POST">
            @csrf
            <div class="form-group">
                <textarea required="required" id="w3review" name="queryText" rows="4" cols="50"></textarea>
            </div>
            <select name="country" class="selectpicker countrypicker" data-flag="true" >
                <option value="fr_fr">French France)</option>
                <option value="en_gb">English (Great Britain)</option>
                <option value="en_us">English (US)</option>
                <option value="en_ca">English (Canada)</option>
                <option value="es_es">Spanish (Spain)</option>
                <option value="de_de">German (Germany)</option>
                <option value="de_at">German (Austria)</option>
                <option value="fr_lu">French (Luxembourg)</option>
                <option value="fr_ch">French (Switzerland)</option>
                <option value="fr_be">French (Belgium)</option>
                <option value="it_it">Italian (Italy)</option>
                <option value="pt_br">Portuguese (Brazil)</option>
                <option value="pt_pt">Portuguese (Portugal)</option>
                <option value="fr_ca">French (Canada)</option>
                <option value="nl_nl">Dutch (Netherlands)</option>
                <option value="pl_pl">Polish (Poland)</option>
                <option value="ro_ro">Romanian (Romania)</option>
                <option value="es_mx">Spanish (Mexico)</option>
                <option value="en_au">English (Australia)</option>
                <option value="fr_ma">French (Morocco)</option>
                <option value="de_ch">German (Switzerland)</option>
            </select><br>
            <div class="btn">
                <button type="submit" style="margin-top: 10px" class="btn btn-success">Send</button>
            </div>
        </form>
    </div>
</body>
</html>
