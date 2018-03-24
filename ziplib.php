<?php
    /*
    * Direct port from the Python lib found here
    * -> https://github.com/mattlisiv/newsapi-python/blob/master/newsapi/newsapi_client.py
    *
    *
    *
    *
    *
    */
    class NewsApiClient {

        private $api_key;
        public $api_url;

        public function __construct($api_key, $api_url='https://newsapi.org/v2/'){
            $this->api_key = 'apiKey=' . $api_key;
            $this->api_url = $api_url;
        }

        public function get_top_headlines($q=null, $sources=null, $language=null, $country=null, $category=null, $page_size=null, $page=null){
            $payload = array();
            $payload['q'] = $q;
            $payload['sources'] = implode(',', $sources);
            $payload['language'] = $language;
            $payload['country'] = $country;
            $payload['category'] = $category;
            $payload['pageSize'] = $page_size;
            $payload['page'] = $page;

            $_url = $this->api_url . 'top-headlines?' . $this->api_key;
            foreach ($payload as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;
        }


        public function get_everything($q=null, $sources=null, $language=null, $from_parameter=null, $to=null, $domains=null, $sort_by=null, $page=null, $page_size=null){

            $payload = array();
            $payload['q'] = $q;
            $payload['sources'] = implode(',', $sources);
            $payload['domains'] = $domains;
            $payload['from'] = $from_parameter;
            $payload['to'] = $to;
            $payload['language'] = $language;
            $payload['sortBy'] = $sort_by;
            $payload['page'] = $page;
            $payload['pageSize'] = $page_size;

            $_url = $this->api_url . 'everything?' . $this->api_key;
            foreach ($payload as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;
        }


        public function get_sources($category=null, $language=null, $country=null){

            $payload = array();
            $payload['category'] = $category;
            $payload['language'] = $language;
            $payload['country'] = $country;

            $_url = $this->api_url . 'sources?' . $this->api_key;
            foreach ($payload as $key=>$item){
                if (!is_null($item) and !empty($item)){
                    $_url .= '&' . $key . '=' .$item;
                }
            }

            $json = file_get_contents($_url);
            $obj = json_decode($json, true);
            return $obj;

        }
    }