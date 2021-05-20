<?php



namespace App\Tools;

use App\Db;
use App\Models\Link;
use Query\phpQuery\phpQueryPlugins;
use Query\phpQuery;
use Unirest\Request;
use function Composer\Autoload\includeFile;


class Tools
{
    const HOST = 'https://www.proficosmetics.ru';
    private $Request;
    private $url;
    public $code;
    private $headers;
    public $body;
    public $rawBody;
    private $newpageurl = '';
    public $arLinks;
    private $headersResponse;



    public function __construct($url)
    {
        set_time_limit(0);
        $this->url = $url;
        $this->Request = new Request();
        $this->headers = (include __DIR__ . '/../../config.php')['headers'];

    }

    public function getPages()
    {
        $i = 1;
        $page = true;
        while($page){
            if(empty($this->newpageurl)) $this->newpageurl = $this->url;
            $response = $this->Request::get($this->newpageurl, $this->headers, $parameters = null);
            $this->code=$response->code;        // HTTP Статус код
            $this->headersResponse = $response->headers;     // Заголовок
            $this->body = $response->body;
            $this->rawBody = $response->raw_body;
            if( $this->code == 200){
                if(!file_exists(__DIR__ . "/../../res/hair/hair-{$i}.txt")){
                    file_put_contents(__DIR__ . "/../../res/hair/hair-{$i}.txt",  $this->rawBody);
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

    public function getHtml()
    {
        $arLinks = [];
        $i=1;
        while(file_exists(__DIR__ . "/../../res/hair/hair-{$i}.txt")){
            $html = file_get_contents(__DIR__ . "/../../res/hair/hair-{$i}.txt");
            //var_dump($html);
            preg_match_all('#<div class="catalogprice">.+<ul>.+<\/ul>.+<div class="pager">#s',$html,$res);

            $resHtml = preg_replace('#<div class="pager">#', '</div>',$res[0][0]);
            file_put_contents(__DIR__ . "/../../res/hair/html/hair-{$i}.txt",  $resHtml);
            $i++;
        }
        return $this;

    }

    public function getLinks()
    {

        $href = [];
        $i=1;

        while(file_exists(__DIR__ . "/../../res/hair/html/hair-{$i}.txt")){
            $html = file_get_contents(__DIR__ . "/../../res/hair/html/hair-{$i}.txt");
            $pq = phpQuery::newDocument($html);
            $elem = $pq->find('.photo a');
           foreach($elem as $key=>$value){
               $pqLink = phpQuery::pq($value);
               $href[] = self::HOST . $pqLink->attr('href');
               $new_link = new Link();
               $new_link->id_cat = 1;
               $new_link->name_cat = 'Все для волос';
               $new_link->alias_cat = 'everything_for_hair';
               $new_link->abslink =  self::HOST . $pqLink->attr('href');
               $new_link->insert();
           }
            $i++;
        }
        $this->arLinks = json_encode($href);
        if(!file_exists(__DIR__ . "/../../res/hair/html/hair_links_json.txt")){
            file_put_contents(__DIR__ . "/../../res/hair/html/json/hair_links_json.txt",  $this->arLinks);
        }

        return $this;
    }

    public function parsePages()
    {
        $arrLinks = Link::findAll();

        foreach($arrLinks as $value){
            $link = $value->abslink;
            preg_match('/[0-9]+/',$link,$codeItem);

            $response = $this->Request::get($link, $this->headers, $parameters = null);
            $code=$response->code;        // HTTP Статус код
            $rawBody = $response->raw_body;
            if( $code == 200) {
                if (!file_exists(__DIR__ . "/../../res/hair/items/hair-{$codeItem[0]}.txt")) {
                    file_put_contents(__DIR__ . "/../../res/hair/items/hair-{$codeItem[0]}.txt", $rawBody);
                }
            }
            usleep(random_int(200,500));
        }

    }




}