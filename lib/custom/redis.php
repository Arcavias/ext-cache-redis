<?php

require_once dirname( dirname( dirname( dirname( __DIR__ ) ) ) ) . '/vendor/autoload.php';
require_once __DIR__ . '/src/MW/Cache/Redis.php';

$client = new MW_Cache_Redis( array( 'siteid' => -1 ), new Predis\Client() );

$client->set( 'arc-single-key', 'single-value' );
echo $client->get( 'arc-single-key' ) . PHP_EOL;
echo $client->get( 'arc-no-key', 'none' ) . PHP_EOL;

$client->setList( array( 'arc-mkey1' => 'mvalue1', 'arc-mkey2' => 'mvalue2' ) );
print_r( $client->getList( array( 'arc-mkey1', 'arc-mkey2' ) ) ). PHP_EOL;

$pairs = array( 'arc-mkey1' => 'mvalue1', 'arc-mkey2' => 'mvalue2' );
$tags = array( 'arc-mkey1' => 'arc-mtag1', 'arc-mkey2' => 'arc-mtag2' );
$client->setList( $pairs, $tags );
print_r( $client->getListByTags( array( 'arc-mtag1', 'arc-mtag2' ) ) ). PHP_EOL;

$client->deleteByTags( array( 'arc-mtag1', 'arc-mtag2' ) );
$client->deleteList( array( 'arc-single-key' ) );