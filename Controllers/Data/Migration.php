<?php

namespace Controllers\Data;

use Repository\Setup\OrmSetup;
use Helpers\HttpRequest;
use Helpers\HttpResponse;

class Migration {

    /**
     * @HttpMethod("POST")
     */
    public function Seed() {
        try {
            $setup = new OrmSetup();
            $setup->seed_data();

            $message = [
                'status code' => 200,
                'status' => 'Success',
                'message' => 'Database has been successfully created'
            ];

            return HttpResponse::Ok($message);
        } catch (Exception $ex) {
            return HttpResponse::BadRequest('Database Creation Failed');
        }
    }
}

?>