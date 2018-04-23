<?php

namespace App\Http\Controllers;

use App;
use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(Request $request) {
		$per_page = 10;
		$q = $request->query();
		if (array_key_exists('per_page', $q) && ctype_digit($q['per_page']) && intval($q['per_page']) > 0) {
			$per_page = intval($q['per_page']);
		}
		$articles = Article::paginate($per_page);
		return ArticleResource::collection($articles);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$article = new Article([
			'user_id'     => 1, //TODO replace
			'title'       => $request->get('title'),
			'slug'        => $request->get('slug'),
			'description' => $request->get('description'),
			'body'        => $request->get('body'),
		]);
		$article->save();

		return response()->json('Successfully added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string $slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($slug) {
		$article = Article::whereTranslation('slug', $slug)->firstOrFail();

		if ($article->translate()->where('slug', $slug)->first()->locale != app()->getLocale()) {
			return redirect()->route('post.show', $article->translate()->slug);
		}

		return response()->json($article);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$article = Article::find($id);

		return response()->json($article);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$article              = Article::find($id);
		$article->title       = $request->get('title');
		$article->slug        = $request->get('slug');
		$article->description = $request->get('description');
		$article->body        = $request->get('body');
		$article->save();

		return response()->json('Successfully Updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$article = Article::find($id);
		$article->delete();

		return response()->json('Successfully Deleted');
	}
}
