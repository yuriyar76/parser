<?php
	use App\curl;
    set_time_limit(0);
    
	$c = curl::app('https://en.wikipedia.org')
					->config_load('wiki.cnf');

    $countries = json_decode(file_get_contents('res/all'));                
    $done = 0;   
        
    foreach($countries as $href => $name){
        $data = $c->request($href);
        file_put_contents('res/country_every/' . $name, $data['html']);
        $done++;    

        sleep(mt_rand(0, 1));
    }
    
    
    echo "done: $done<br>";