<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Auth\Access\Gate;

class ArticleController extends Controller
{
   public function index(){
      // $data= [
      //    ["id" => 1, "title" => "First Article"],
      //    ["id" => 2, "title" => "Second Article"],
      // ];
      $data = Article::latest()->paginate(5);

    return view('articles/index', ['articles' => $data]);
   }

   public function detail($id) {
      $data = Article::find($id);
      
   //  return "Controller - Article Detail - $id";
   return view('articles.detail', ['article' => $data ]);
   }

   public function add() {
      $data = [
         ["id" => 1, "name" => "News"],
         ["id" => 2, "name" => "Tech"],
      ];

      return view('articles/add', ['categories' => $data]);
   }

   public function create(){
      $validator = validator(request()->all(), [
         'title' => 'required',
         'body' => 'required',
         'category_id' => 'required',
      ]);
       
      if($validator->fails()){
         return back() ->withErrors($validator);
      }

      $article = new Article();
      $article->title = request()->title;
      $article->body = request()->body;
      $article->category_id = request()->category_id;
      $article ->user_id = auth()->user()->id;
      $article->save();

      return redirect('/articles');
   }

   public function delete($id){
      $article = Article::find($id);

      if( Gate::allows('article-delete', $article)){
         $article->delete();
         return redirect('/articles')->with('info', 'Article Deleted');
      }
      else{
         return redirect('/articles')->with('error', 'Unauthorize');
     }
     
   }

   // for authorization
   public function __construct()
   {
      $this->middleware('auth')->except(['index', 'detail']);
   }
}