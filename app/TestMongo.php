<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TestMongo extends Eloquent
{
    protected $table = "test_mongos";

    public function testMongo($data)
    {
        $mongo = new TestMongo();
        $mongo->name = $data['name'];
        $mongo->save();
        
        return $mongo; 
    }
}
