<?php
 
namespace Modules\PkgProjets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PkgProjets\Models\Tag;


class Projet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom' ,
        'description',    
    ];
   
   
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'projet_tags')->withTimestamps();
    }
}

