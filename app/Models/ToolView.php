<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolView extends Model
{
    protected $fillable = ['tool_id', 'ip'];
    public $timestamps = false;

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }
}
