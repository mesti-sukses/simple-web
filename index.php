<?php
    require 'vendor/autoload.php';
    require 'Page.php';
    require 'Feed.php';

    $f3 = \Base::instance();

    include 'host.php';
    $f3->set('DB', new DB\SQL('sqlite:data.db'));

    $f3->route('GET /', 'Page->index');
    $f3->route('GET /category/@id', 'Page->category');
    $f3->route('GET /post/@fileName', 'Page->post');
    $f3->route('GET /idea', 'Page->idea');
    $f3->route('GET /book', 'Page->book');
    $f3->route('GET /book/@fileName', 'Page->summary');
    $f3->route('GET /rss', 'Page->rss');
    $f3->route('GET /filsafat-itu-penting', 'Page->bukuFilsafat');

    $f3->run();
?>