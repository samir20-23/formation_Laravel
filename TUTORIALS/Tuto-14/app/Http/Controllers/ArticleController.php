<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function update(Request $request , Article $article){
        $this->authorize('update' , $article);
        $article->update($request->all());
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès .');

    }

    public function destroy(Article $article){
        $this->authorize('delete' , $article);
        $article->delete ;
        return redirect()->route('articles.index')->with('success', 'Article suprimé avec succés .');
    }
}
