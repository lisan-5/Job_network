<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; // Use Eloquent Model for ORM functionality
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory; // Use HasFactory trait for factory methods

    protected $table = 'job_listings'; // Specify the table name
    protected $fillable = ['employer_id', 'title', 'company', 'location', ]; 

   // protected $guarded = []; // Specify attributes that are not mass assignable

    public function employer()
    {
        return $this->belongsTo(Employer::class); // Define the relationship with Employer model
    }
    public function tags(){
        return $this->belongsToMany(Tag::class, 'job_tags', 'job_id', 'tag_id'); // Define the many-to-many relationship with Tag model
    }
    /**
     * The users who have favorited this job.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites', 'job_id', 'user_id')->withTimestamps();
    }
  
}