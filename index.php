<?php
if($_GET['callback']){
    $data = json_decode(file_get_contents("http://www.census.gov/popclock/data/population/world"),true);
    header('Content-Type: application/json');
    echo $_GET['callback']."(". json_encode(array('population'=>$data['world']['population'])).")";
    exit;
}
?>
<!DOCTYPE html> 
<html lang="en"> 
<head>
    <title>World Population</title>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"></meta>
    <meta name=viewport content="width=device-width, initial-scale=1">

<style>
body {
    background-color: #FFF;
    color: gray;
    margin: 10% 5% 0px;
    text-align: center;
    font-family: Arial,Verdana,sans-serif;
    font-size:60%;
}
#container {
    clear: both;
    font-size: 3em;
    margin: auto;
}
</style>
</head>
<body>
<div id="container">
<h1>World Population</h1>
<h2 id="population">...</h2>
</div>
<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
function repeatMe(){
    $.ajax({
        url: 'http://population.ml/?callback=show',
            type: 'GET',
            dataType: 'jsonp',
            cache: false,
            success: function(data) {
                $('#population').html(data.population);
                setTimeout(repeatMe, 500);
            },
                error: function(a,b,c){
                    console.log(b);
                    $('#population').html('Error');
                    setTimeout(repeatMe, 500);
                }
    });
}

(function(){
    repeatMe();
})();
</script>
</body>
</html>
