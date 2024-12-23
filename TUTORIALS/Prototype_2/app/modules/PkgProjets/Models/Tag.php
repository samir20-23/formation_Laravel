<?php

namespace Modules\PkgProjets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PkgProjets\Models\Projet;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom' ,
        'description',    
    ];
   
   
    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'projet_tags')->withTimestamps();
    }
}

