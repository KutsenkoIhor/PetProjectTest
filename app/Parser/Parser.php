<?php
namespace App\Parser;

require 'vendor/autoload.php';
use PicoFeed\Reader\Reader;
use App\Jobs\TrackParser;
use App\Models\RSS_feeds;

class Parser
{
    public function get_url()
    {
//        $val = RSS_feeds::all();
//        echo $val;
        $val = RSS_feeds::find(1);
//        print_r($val->feed . "\n");
        TrackParser::dispatch($val->feed);
    }

    public function pars($url = null)
    {
//        print_r($url);procespars
        $reader = new Reader;
        $resource = $reader->download($url);
        $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );
        $feed = $parser->execute();
//        print_r("\n" . 'good');
//        print_r($feed);
//        print_r(gettype($feed));


        print_r($feed->items[0]->getTitle());
        print_r($feed->items[0]->getContent());
        print_r($feed->items[0]->getUrl());
    }
}
