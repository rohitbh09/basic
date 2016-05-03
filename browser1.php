<?php

function getOS( $u_agent ) {

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array( '/webos/i'              =>  'Mobile',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/android/i'            =>  'Android',
                                '/ipad/i'               =>  'iPad',
                                '/ipod/i'               =>  'iPod',
                                '/iphone/i'             =>  'iPhone',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/linux/i'              =>  'Linux',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/win16/i'              =>  'Windows 3.11',
                                '/win95/i'              =>  'Windows 95',
                                '/win98/i'              =>  'Windows 98',
                                '/windows me/i'         =>  'Windows ME',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 10/i'     =>  'Windows 10'
                              );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $u_agent)) {
            $os_platform    =   $value;
            return $os_platform;
        }
    }
    return $os_platform;

}

function getBrowser($u_agent)
{

  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
  {
      $bname = 'Internet Explorer';
      $ub = "MSIE";
  }
  elseif(preg_match('/Trident/i',$u_agent))
  { // this condition is for IE11
      $bname = 'Internet Explorer';
      $ub = "rv";
  }
  elseif(preg_match('/Firefox/i',$u_agent))
  {
      $bname = 'Mozilla Firefox';
      $ub = "Firefox";
  }
  elseif(preg_match('/Chrome/i',$u_agent))
  {
      $bname = 'Google Chrome';
      $ub = "Chrome";
  }
  elseif(preg_match('/Safari/i',$u_agent))
  {
      $bname = 'Apple Safari';
      $ub = "Safari";
  }
  elseif(preg_match('/Opera/i',$u_agent))
  {
      $bname = 'Opera';
      $ub = "Opera";
  }
  elseif(preg_match('/Netscape/i',$u_agent))
  {
      $bname = 'Netscape';
      $ub = "Netscape";
  }

  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) .
   ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
      // we have no matching number just continue
  }

  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
      //we will have two since we are not using 'other' argument yet
      //see if version is before or after the name
      if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
          $version= $matches['version'][0];
      }
      else {
          $version= $matches['version'][1];
      }
  }
  else {
      $version= $matches['version'][0];
  }

  $browserObj = new stdClass();
  $browserObj->bname = $bname;
  $browserObj->ub = $ub;
  $browserObj->version = $version;
  return $browserObj;
}

function getBrowserDetail()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";


    $platform = getOS( $u_agent );
    $browserObj = getBrowser($u_agent);
    // Next get the name of the useragent yes seperately and for good reason
    $bname = $browserObj->bname ;
    $version = $browserObj->version ;


    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

// now try it
$ua=getBrowserDetail();
print("Browser Name:". $ua['name']."\n<br/>");
print("Browser Version:". $ua['version']."\n<br/>");
print("Browser Platform:". $ua['platform']."\n<br/>");

// $yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
// print_r($yourbrowser);
?>
