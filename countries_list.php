<?php
	include_once('lib/curl.php');
	include_once('lib/simple_html_dom.php');
	
	$c = curl::app('https://en.wikipedia.org')
					->config_load('wiki.cnf');

	$data = $c->request('wiki/List_of_sovereign_states');
	$dom = str_get_html($data['html']);
    
    $flags = $dom->find('.flagicon');
    $done = 0;
    $countries = array();
    
    foreach($flags as $span){
        $b = $span->parent();
    
        if($b->tag != 'b')
            continue;
           
        $a = $b->find('a', 0);
        $countries[$a->href] = $a->plaintext;            
        $done++;       
    }
    
    echo '<pre>';
    print_r($countries);
    echo '</pre>';
    
    file_put_contents('res/all', json_encode($countries));
    
    echo "<br>done: $done<br>";