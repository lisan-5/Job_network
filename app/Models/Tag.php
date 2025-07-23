<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

        
    public function jobs(){
        return $this->belongsToMany(Job::class, 'job_tags', 'tag_id', 'job_id'); // Define the many-to-many relationship with Job model
    }
}
