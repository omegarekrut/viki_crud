<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOutput extends Model
{
    protected $table = 'data';

    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->get();
    }
}
