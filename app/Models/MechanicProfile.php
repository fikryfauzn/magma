<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicProfile extends Model
{
    use HasFactory;

    // Define the table name explicitly if it's not the plural of the model
    protected $table = 'mechanic_profile';  // Table name
    
    // Define the primary key if it's different from the default `id`
    protected $primaryKey = 'mechanic_id';

    // Define the fillable attributes
    protected $fillable = [
        'user_id', 
        'specialization', 
        'availability_schedule', 
        'service_history'
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Link user_id to the users table
    }
}
