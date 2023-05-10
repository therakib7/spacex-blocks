<?php
namespace Bfsb\Ctrl\Api\Type; 

class SpaceX
{
    public function __construct()
    {
        add_action("rest_api_init", [$this, "rest_routes"]);
    }

    public function rest_routes()
    {
        register_rest_route("bfsb/v1", "/spacex-data", [
            [
                "methods" => "GET",
                "callback" => [$this, "get"],
                "permission_callback" => [$this, "get_per"],
            ]
        ]);
       
    }

    public function get($req)
    {
        $param = $req->get_params();

        $per_page = 10;
        $offset = 0;

        if (isset($param["per_page"])) {
            $per_page = $param["per_page"];
        }

        if (isset($param["page"]) && $param["page"] > 1) {
            $offset = $per_page * $param["page"] - $per_page;
        }

        $query = [];
        $name = isset($param["name"]) ? sanitize_text_field($param["name"]) : '';
        if ( $name ) {
            $query['name'] = $name;
        } 

        $status = isset($param["status"]) ? rest_sanitize_boolean($param["status"]) : '';
        if ( isset($param["status"]) ) {
            $query['active'] = $status;
        } 

        $country = isset($param["country"]) ? sanitize_text_field($param["country"]) : '';
        if ( $country ) {
            $query['country'] = $country;
        }

        $resp = wp_remote_post( 'https://api.spacexdata.com/v4/rockets/query', [ 
            'body' => [
                'query' => $query,
                'options' => [
                    'offset' => $offset,
                    'limit' => $per_page
                ]
            ], 
            'sslverify' => false
        ] );  
        
        $result = $data = [];

        if ( !is_wp_error( $resp ) ) {
            $data = json_decode( wp_remote_retrieve_body( $resp ) );            
        } else {
            $error_msg = $resp->get_error_message(); 
        }
        
        $result['result'] = $data; 

        wp_send_json_success($result);

        wp_send_json_success(666);
    }

    // check permission
    public function get_per()
    {
        // return true;
        return is_user_logged_in();
    }
}
