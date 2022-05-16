<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    use HasFactory;
    // protected $table = "tugas";

    // protected $fillable = [];

    protected $guarded = [
        'id',
    ];

    // public $timestamps = false;
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}