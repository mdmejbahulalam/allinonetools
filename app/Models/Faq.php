<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['tool_id', 'question', 'answer'];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
