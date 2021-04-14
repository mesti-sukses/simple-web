<?php
    class Page{

        function index($f3){
            $labelData = $f3->get('DB')->exec("SELECT id_label, nama FROM label");

            foreach ($labelData as $id => $label) {
                $postData = $f3->get('DB')->exec('SELECT id_category, judul FROM category WHERE label="'.$label['id_label'].'"');
                $labelData[$id]['categories'] = $postData;
            }
            $f3->set('labels', $labelData);

            $parseDown = new Parsedown();
            $ideData = $f3->get('DB')->exec('SELECT * FROM idea');
            $ide_1 = rand(0, count($ideData)-1);
            $firstIdea = $ideData[$ide_1];
            $firstIdea['print'] = $parseDown->text($firstIdea['content']);
            $firstIdea['detail_print'] = $parseDown->text($firstIdea['detail']);
            // print_r($firstIdea);
            $f3->set('firstIdea', $firstIdea);

            echo Template::instance()->render('Template/index.html');
        }

        function category($f3){
            $id = $f3->get('PARAMS.id');
            $categoryData = $f3->get('DB')->exec("SELECT id_category, label, judul, deskripsi, nama FROM category JOIN label on label.id_label = category.label WHERE id_category=".$id);
            // print_r($postData);

            foreach ($categoryData as $id => $category) {
                $postData = $f3->get('DB')->exec('SELECT title, file_name FROM posts WHERE category="'.$category['id_category'].'"');
                $categoryData[$id]['posts'] = $postData;
            }
            $relatedCategory = $f3->get('DB')->exec("SELECT id_category, judul FROM category WHERE label=".$categoryData[0]['label']);
            $f3->set('categories', $categoryData);
            $f3->set('related', $relatedCategory);
            // print_r($categoryData);

            echo Template::instance()->render('Template/category.html');
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
            $relatedPost = $f3->get('DB')->exec(
                "SELECT * FROM posts WHERE category='".
                $postData[0]['category'].
                "'"
            );
            $f3->set('relatedPost', $relatedPost);
            $f3->set('post', $postData[0]);

            echo Template::instance()->render('Template/post.html');
        }

        function idea($f3){
            $parseDown = new Parsedown();
            $ideData = $f3->get('DB')->exec('SELECT * FROM idea');
            $ide_1 = rand(0, count($ideData)-1);
            $ide_2 = rand(0, count($ideData)-1);
            $firstIdea = $ideData[$ide_1];
            $secondIdea = $ideData[$ide_2];
            $firstIdea['print'] = $parseDown->text($firstIdea['content']);
            $firstIdea['detail_print'] = $parseDown->text($firstIdea['detail']);
            $secondIdea['print'] = $parseDown->text($secondIdea['content']);
            $secondIdea['detail_print'] = $parseDown->text($secondIdea['detail']);
            // print_r($firstIdea);
            $f3->set('firstIdea', $firstIdea);
            $f3->set('secondIdea', $secondIdea);
            echo Template::instance()->render('Template/idea.html');
        }

        function book($f3){
            $bookData = $f3->get('DB')->exec("SELECT file_name, judul  FROM book ORDER BY judul ASC");
            // print_r($postData);
            $f3->set('books', $bookData);
            // print_r($categoryData);

            echo Template::instance()->render('Template/book.html');
        }

        function summary($f3){
            $parseDown = new Parsedown();
            $file_name = $f3->get('base').'article/rangkuman/'.$f3->get('PARAMS.fileName');
            $html = $parseDown->text(file_get_contents($file_name));
            $f3->set('content', $html);

            $postData = $f3->get('DB')->exec(
                "SELECT * FROM book WHERE file_name='".
                $f3->get('PARAMS.fileName').
                "'"
            );
            $f3->set('book', $postData[0]);

            echo Template::instance()->render('Template/summary.html');
        }
    }
?>