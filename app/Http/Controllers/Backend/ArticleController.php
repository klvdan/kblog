<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App;
use Datetime;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll() {
        return view('backend.article_list');
    }

    public function list() {
        $articles = Article::all();
        $data = [];
        foreach ($articles as $a) {
            $obj = [
                'title' => $a->title,
                'author' => $a->author,
                'tags' => $a->tags()->get(),
                'categories' => $a->categories()->get(),
                'create_at' => (new Datetime($a->create_at))->format('Y-m-d H:i:s'),
                'update_at' => (new Datetime($a->create_at))->format('Y-m-d H:i:s'),
            ];
            $data[] = $obj;
        }
        return response()->json($data);
    }

    public function add(Request $request) {
        $data = $request->all();

        $article = Article::where('title', $data['title'])->first();
        if (!empty($article)) {
            return response()->json([
                'msg' => "Title duplicated!"
            ]);
        }

        $article = new Article;
        $article->title = $data['title'];
        $article->author = Auth::user()->name;
        $article->content = $data['md'];
        $article->save();

        $tags = explode(',', $data['tag']);
        foreach ($tags as $t) {
            $tag = Tag::where('name', $t)->first();
            if (empty($tag)) {
                $tag = new Tag;
                $tag->name = $t;
                $tag->save();
            }

            $a_t = DB::select('select * from article_tag where article_id = :aid and tag_id = :tid',
            ['aid' => $article->id, 'tid' => $tag->id]);
            if (empty($a_t)) {
                DB::insert('insert into article_tag (article_id, tag_id) values (?,?)', 
                [$article->id, $tag->id]);
            }
        }
        

        $category = Category::where('name', $data['tag'])->first();
        if (empty($category)) {
            $category = new Category;
            $category->name = $data['category'];
            $category->save();
        }

        

        $a_c = DB::select('select * from article_category where article_id = :aid and category_id = :cid',
            ['aid' => $article->id, 'cid' => $category->id]);
        if (empty($a_c)) {
            DB::insert('insert into article_category (article_id, category_id) values (?,?)', 
            [$article->id, $category->id]);
        }

        $mdpath = $this->saveToMarkdown($data['title'],$data['md'],$data['tag'],$data['category']);

        if ($mdpath != '') {
            $article->filepath = $mdpath;
            $article->save();
        }
        
        return response()->json('OK');
    }

    public function addNew() {
        return view('backend.article_add');
    } 

    public function update() 
    {

    } 

    public function delete() 
    {

    }

    public function imageUpload(Request $request) 
    {
        $file = Storage::disk('images')->putFile(date('Ym'), $request->file('image'));
        $url = Storage::url($file);
        $fullpath = $request->root() . $url;
        return response()->json($fullpath);
    }

    public function download() 
    {
    }

    /**
     * Chart data
     * 
     * @return json
     */
    public function chart() 
    {
        return response()->json([["2018-06",5],["2019-07",10],["2020-06",12],["2020-07",8]]);
    }

    private function saveToMarkdown($title, $md, $tag, $category) 
    {
        $d = date('Y-m-d');
        $content = <<<EOF
---
title: $title
date: $d
tags:
  - $tag       
categories:
  - $category
---

$md
EOF;

        $path = date('Ym') . '/' . date('mdH') . '.md';
        $file = Storage::disk('markdown')->put($path, $content);
        if ($file) {
            return $path;
        } else {
            return '';
        }
    }
}
