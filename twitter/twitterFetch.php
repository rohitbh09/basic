<?php
require_once 'TwitterAPIExchange.php';
 
 
 $settings = array(
    'oauth_access_token' => "144758634-ELH4mtSq3quW9kltw0ENznaZSo3KbZhTRb3BOYHc",
    'oauth_access_token_secret' => "mYBFMK9PdO2K50QqvhCKLjamCtTWe7cFz4aXCYtRq2czV",
    'consumer_key' => "tqSBvzkhjZg0TVlMSI10cZmdp",
    'consumer_secret' => "06H7LIjLksmZBkr38feaeC0uOC2UknVE4skad082IrromwVORU",
    "CURLOPT_HTTPHEADER" => 'https://api.twitter.com',
    "CURLOPT_HEADER" => false,
    "CURLOPT_URL" => 'https://api.twitter.com',
    "CURLOPT_RETURNTRANSFER" => true,
    "CURLOPT_TIMEOUT" => 20,
    "CURLOPT_SSL_VERIFYPEER" => false,
    "CURLOPT_SSL_VERIFYHOST" => false
);



$url = "https://api.twitter.com/1.1/search/tweets.json";
$requestMethod = "GET";
$getfield = '?q=@brightpodapp&result_type=recent&count=10';
// $getfield = '?q=brightpodapp&result_type=recent&since=2016-03-28&until=2016-03-30';

$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
                      ->buildOauth($url, $requestMethod)
                      ->performRequest(),$assoc = TRUE);
// if( $string["errors"][0]["message"] != "") {
//   echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".
//         $string[errors][0]["message"]."</em></p>";
//         exit();
//       }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="twitterStyle.css">
</head>
<body>

 <?php foreach($string['statuses'] as $items)
    {
        echo str_replace("@brightpodapp","<b>@brightpodapp</b>", $items['text'] );
        echo "<br/>";
        echo $items['created_at'];
        echo "<br/>";
        echo "<br/>";
        // echo "Tweet: ". $items['text']."<br />";
        // echo "Tweeted by: ". $items['user']['name']."<br />";
        // echo "Screen name: ". $items['user']['screen_name']."<br />";
        // echo "Followers: ". $items['user']['followers_count']."<br />";
        // echo "Friends: ". $items['user']['friends_count']."<br />";
        // echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
    } ?>
</body>
</html>