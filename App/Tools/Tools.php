<?php



namespace App\Tools;

use Query\phpQuery\phpQueryPlugins;
use Query\phpQuery;
use Unirest\Request;
use function simplehtmldom_1_5\file_get_html;


class Tools
{
    private $Request;
    private $PhpQuery;
    private $url;
    public $code;
    public $headers;
    public $body;
    public $rawBody;
    private $newpageurl = '';


    public function __construct($url)
    {
        $this->url = $url;
        if(!($this->Request instanceof Request))
           $this->Request = new Request();


    }

    public function getPages()
    {
        set_time_limit(0);
        $headers = [
            'Accept'=> 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
             'Accept-Encoding' => 'gzip, deflate',
             'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
             'Connection' => 'keep-alive',
             'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'
        ];
        $i = 1;
        $page = true;
        while($page){
            if(empty($this->newpageurl)) $this->newpageurl = $this->url;
            $response = $this->Request::get($this->newpageurl, $headers, $parameters = null);
            $this->code=$response->code;        // HTTP Статус код
            $this->headers = $response->headers;     // Заголовок
            $this->body = $response->body;
            $this->rawBody = $response->raw_body;
            if( $this->code == 200){
                if(!file_exists(__DIR__ . "/../../res/hair-{$i}.txt")){
                    file_put_contents(__DIR__ . "/../../res/hair-{$i}.txt",  $this->rawBody);
                }

                $i++;
                $this->newpageurl = $this->url . "/p{$i}/";

                usleep(random_int(200,500));


            }else{
                $page = false;
            }

        }
        return $this;
    }

    public function getLincs()
    {

        $i=1;
        while(file_exists(__DIR__ . "/../../res/hair-{$i}.txt")){
            $html = file_get_contents(__DIR__ . "/../../res/hair-{$i}.txt");
            $dom = phpQuery::newDocument($html);
            foreach($dom->find('.catalogprice .tumb') as $collect){
                $collect= phpQuery::pq($collect);
                var_dump($collect);
                exit;

            }
        }
    }


}