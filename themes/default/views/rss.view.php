<?php
header('Content-Type: text/xml; charset=utf-8', true);


$rss = new SimpleXMLElement('<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
$rss->addAttribute('version', '2.0');

$channel = $rss->addChild('channel');

$atom = $rss->addChild('atom:atom:link');
$atom->addAttribute('href', $url);
$atom->addAttribute('rel', 'self');
$atom->addAttribute('type', 'application/rss+xml');

$title = $rss->addChild('title',$sitename); 
$description = $rss->addChild('description','Flux RSS du site '.$sitename);
$link = $rss->addChild('link',$url);
$language = $rss->addChild('language','fr-fr'); 

//Create RFC822 Date format to comply with RFC822
$date_f = date("D, d M Y H:i:s T", time());
$build_date = gmdate(DATE_RFC2822, strtotime($date_f)); 
$lastBuildDate = $rss->addChild('lastBuildDate',$date_f);

$generator = $rss->addChild('generator','PHP Simple XML');

foreach($articles as $article)
{
    $item = $rss->addChild('item');
    $title = $item->addChild('title', $article['title']);
    $link = $item->addChild('link', $url.'/'.$article['slug']);
    $guid = $item->addChild('guid', $url.'/'.$article['slug']);
    $guid->addAttribute('isPermaLink', 'true');
    
    $description = $item->addChild('description', '<![CDATA['. htmlentities($article['content']) . ']]>');
    
    $date_rfc = gmdate(DATE_RFC2822, strtotime($article['datePublied']));
}

if($page == 1 || !isset($page)){
$test = $rss->addChild('atom:link',$url.'/rss?page=2');
}
if($page >= 2){
$test2 = $rss->addChild('atom:link',$url.'/rss?page='.($page-1));
$test3 = $rss->addChild('atom:link',$url.'/rss?page='.($page+1));	
}

echo $rss->asXML();