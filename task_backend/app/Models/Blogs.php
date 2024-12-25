<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'description',
        'category_id', // Added category_id here
        'user_id',
    ];

    // Define the relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class); // Each blog belongs to a category
    }

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
