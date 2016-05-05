<?php

  // include twitter api exchange library
    require_once 'TwitterAPIExchange.php';

  // Twitter Api exchange Setting define
    $settings = array(
      'oauth_access_token' => "144758634-ELH4mtSq3quW9kltw0ENznaZSo3KbZhTRb3BOYHc",
      'oauth_access_token_secret' => "mYBFMK9PdO2K50QqvhCKLjamCtTWe7cFz4aXCYtRq2czV",
      'consumer_key' => "tqSBvzkhjZg0TVlMSI10cZmdp",
      'consumer_secret' => "06H7LIjLksmZBkr38feaeC0uOC2UknVE4skad082IrromwVORU",
      "CURLOPT_HTTPHEADER" => 'https://api.twitter.com',
      "CURLOPT_HEADER" => false,
      "CURLOPT_URL" => 'https://api.twitter.com',
      "CURLOPT_RETURNTRANSFER" => true,
      "CURLOPT_TIMEOUT" => 200,
      "CURLOPT_SSL_VERIFYPEER" => false,
      "CURLOPT_SSL_VERIFYHOST" => false
    );


  // Url define To search @brightpodapp
    $url = "https://api.twitter.com/1.1/search/tweets.json";

  // Query string define to search
    $getfield = '?q=@brightpodapp&result_type=recent&count=20';

  // Request method define for Api
    $requestMethod = "GET";

  // Initiated Twitter Api 
    $twitter = new TwitterAPIExchange($settings);

  // Call Twitter Api using url
    $string = json_decode($twitter->setGetfield($getfield)
                          ->buildOauth($url, $requestMethod)
                          ->performRequest(),$assoc = TRUE);


  if( isset($string["errors"][0]["message"]) && $string["errors"][0]["message"] != "") {

    echo "<h3>Sorry, there was a problem.</h3>
          <p>Twitter returned the following error message:</p><p><em>".
          $string[errors][0]["message"]."</em></p>";
          exit();
  }

  if( empty($string['statuses'])){
      echo "NO RESULT FOUND";
      exit();
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="twitterStyle.css">
</head>
<body>
  <?php

    $recentTwitteText = "";
    $recentTwitteDate = "";
    foreach( $string['statuses'] as $index => $items) {

      $twitteText = str_replace("@brightpodapp","<b>@brightpodapp</b>", $items['text'] );
      $twitteDate = $items['created_at'];

        if( $index == 0 ){

          $recentTwitteText = $twitteText;
          $recentTwitteDate = $twitteDate;
        }
        echo $twitteText;
        echo "<br/>";
        echo $twitteDate;
        echo "<br/>";
        echo "<br/>";
    }


    echo "=================================================<br/>";
    echo "MOST RECENT TWITTE<br/>";
    echo "=================================================<br/>";
    echo $recentTwitteText;
    echo "<br/>";
    echo $recentTwitteDate;
  ?>
</body>
</html>