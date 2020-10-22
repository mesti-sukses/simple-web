<?php
    class Page{

        function index($f3){
            $postData = $f3->get('DB')->exec("SELECT * FROM posts");
            $f3->set('posts', $postData);
            // print_r($postData);

            echo Template::instance()->render('Template/index.html');
        }

        function post($f3){
            $parseDown = new Parsedown();
            $file_name = $f3->get('base').'article/'.$f3->get('PARAMS.fileName');
            $html = $parseDown->text(file_get_contents($file_name));
            $f3->set('content', $html);

            $postData = $f3->get('DB')->exec(
                "SELECT * FROM posts WHERE file_name='".
                $f3->get('PARAMS.fileName').
                "'"
            );
            $f3->set('post', $postData[0]);

            echo Template::instance()->render('Template/post.html');
        }

    }
?>