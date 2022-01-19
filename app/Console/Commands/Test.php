<?php

namespace App\Console\Commands;
require 'vendor/autoload.php';
use Illuminate\Console\Command;
use PicoFeed\Config\Config;
use PicoFeed\Reader\Reader;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $config = new Config();
//        $config->setMaxBodySize(4097152);

        $reader = new Reader($config);
        $resource = $reader->download('https://tsn.ua/rss');
//        $resource = $reader->download('http://feeds.feedburner.com/Itcua?format=xml');
                $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );

        $feed = $parser->execute();
        print_r("good test" . "\n");
        print_r($feed->items[0]->getTitle());
        print_r($feed->items[0]->getContent());
        print_r($feed->items[0]->getUrl());
        echo "\n";
        return 0;
    }
}
