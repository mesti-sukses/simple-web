<?php
    require 'vendor/autoload.php';
    require 'Page.php';

    $f3 = \Base::instance();

    include 'host.php';
    $f3->set('DB', new DB\SQL('sqlite:data.db'));

    $f3->route('GET /', 'Page->index');
    $f3->route('GET /post/@fileName', 'Page->post');

    $f3->run();
?>