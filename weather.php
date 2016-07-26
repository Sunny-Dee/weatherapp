<?php
    
    $weather = "";
    $error = "";

   
    
    if ($_GET['city']) {
        
        $city = str_replace(' ', '', $_GET['city']);
        $cityFormatted = ucwords(strtolower($_GET['city']));

        
        $urlContent = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=YOUR OWN API KEY");
        
        $weatherArray = json_decode($urlContent, true);
        
        
        if ($weatherArray['cod'] == 200){
            $tempInFarenheit = intval($weatherArray['main']['temp'] * 9/5 - 459.67);
            $weather = "In ".$cityFormatted." expect ".$weatherArray['weather'][0]['description'].
            ".<br><img src=\"http://openweathermap.org/img/w/".$weatherArray['weather'][0]['icon']
            .".png\"><br>The average temperature is ".$tempInFarenheit."&deg;F";   
        } else {
            $error = "Could not find city - please try again";
        }


    }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/newprojects/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/newprojects/favicon.ico" type="image/x-icon">

    <title>Today's forecast</title>

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Automating Me</h3>
              <nav class="nav nav-masthead">
                <a class="nav-link active" href="http://automatingme.com/">Home</a>
                <a class="nav-link" href="http://automatingme.com/projects/">Back to projects</a>
              </nav>
                
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">What's the weather today?</h1>
            <p class="lead">Enter a city name and our sophisticated app will tell you what to expect for today.</p>
            <form>
                <fieldset class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter a city" value = "<?php echo $_GET['city']; ?>">
                </fieldset>
                 <button type="submit" class="btn btn-lg btn-secondary">Find out!</button>
            </form>
              
              <div id="weather"><?php 
              
                      if ($weather) {

                          echo '<div class="alert alert-info" role="alert">
                              '.$weather.'
                            </div>';

                      } else if ($error) {

                          echo '<div class="alert alert-danger" role="alert">
                              '.$error.'
                            </div>';

                      }

                      ?></div>
    
          </div>
        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    
  </body>
</html>
