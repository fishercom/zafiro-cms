<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Requests\Admin\SortableRequest;

use App\Models\CmsLang;
use App\Models\CmsSite;
use App\Models\CmsSchema;
use App\Models\CmsArticle;

use View;

class ArticleController extends AdminController {
	
	public $schema;
	public $parent;
	public $lang;
	public $site;
	public $module_params;

    public function __construct()
    {
		$schema_id = Request::get('schema_id');
		$parent_id = Request::get('parent_id');
		$lang_id = Request::get('lang_id');
		$site_id = Request::get('site_id');
		$page = Request::get('page');

		if($parent_id!=null){
			$this->parent = CmsArticle::find($parent_id);
			$lang_id=$this->parent->lang_id;
			$this->lang = CmsLang::find($this->parent->lang_id);
		}
		else{
			$this->parent= new CmsArticle;
			if($lang_id!=null)
				$this->lang = CmsLang::find($lang_id);
			else
				$this->lang= CmsLang::where('active', '1')->first();
		}

		if($site_id!=null)
			$this->site = CmsSite::find($site_id);
		else
			$this->site= CmsSite::where('active', '1')->first();

		if($schema_id!=null)
			$this->schema = CmsSchema::find($schema_id);
		else
			$this->schema= new CmsSchema;

		$this->module_params = '?schema_id='.$this->parent->schema_id.'&parent_id='.$this->parent->id.'&site_id='.$this->site->id.'&lang_id='.$this->lang->id.'&page='.$page;

		View::share('schema', $this->schema);
		View::share('parent', $this->parent);
		View::share('lang', $this->lang);
		View::share('site', $this->site);
		View::share('page', $page);

		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = Request::has('filter')? Request::get('filter'): NULL;
		$schemas = CmsSchema::where('parent_id', $this->parent->schema_id)
					->where('group_id', $this->site->schema_group_id)
					->where('active', '1')->orderBy('position', 'asc')->get();
		$langs = CmsLang::where('active', '1')->pluck('name', 'id');
		$sites = CmsSite::where('active', '1')->pluck('name', 'id');

		$list = CmsArticle::select()
			->where('parent_id', $this->parent->id)
			->where('lang_id', $this->lang->id)
			->where('site_id', $this->site->id)
			->where('title', 'LIKE', '%'.$filter.'%')
			->orderBy('position', 'asc');

		$articles = $list->get();
		$articles_pg = $list
			->Paginate()
			->appends([
				'parent_id'=>$this->parent->id,
				'schema_id'=>$this->parent->schema_id,
				'lang_id'=>$this->lang->id,
				'site_id'=>$this->site->id
			]);

		View::share('filter', $filter);
        return view('admin.article.index', compact('articles', 'articles_pg', 'schemas', 'langs', 'sites'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$article=new CmsArticle(Request::all());
		$article->active = '1';

        return view('admin.article.create', compact('article'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArticleRequest $request)
	{

		$article = new CmsArticle;
		$article->schema_id = $request->schema_id;
		if (Request::has('parent_id')) $article->parent_id = $request->parent_id;
		$article->site_id = $this->site->id;
		$article->lang_id = $request->lang_id;
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->subtitle2 = $request->subtitle2;
		$article->resumen = $request->resumen;
		$article->description = $request->description;
		$article->description2 = $request->description2;
		$article->description3 = $request->description3;
		$article->date = $request->date;
		$article->ref_type = $request->ref_type;
		$article->ref_id = $request->ref_id;
		$article->ref_url = $request->ref_url;
		$article->ref_target = $request->ref_target;
		$article->metadata = $request->metadata;
		$article->in_home = $request->in_home;
		$article->active = $request->active;
		$article->save();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = CmsArticle::FindOrFail($id);

        return view('admin.article.edit', compact('article'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ArticleRequest $request, $id)
	{
		$article = CmsArticle::FindOrFail($id);
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->subtitle2 = $request->subtitle2;
		$article->resumen = $request->resumen;
		$article->description = $request->description;
		$article->description2 = $request->description2;
		$article->description3 = $request->description3;
		$article->date = $request->date;
		$article->ref_type = $request->ref_type;
		$article->ref_id = $request->ref_id;
		$article->ref_url = $request->ref_url;
		$article->ref_target = $request->ref_target;
		$article->metadata = $request->metadata;
		$article->in_home = $request->in_home;
		$article->slug = $request->slug;
		$article->active = $request->active;
		$article->save();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sort(SortableRequest $request)
	{
		$list=$request->sortlist;
		$i=1;
		foreach ($list as $id) {
			$article = CmsArticle::FindOrFail($id);
			$article->position = $i++;
			$article->save();
		}

		\App\Util\RegisterLog::add();
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = CmsArticle::FindOrFail($id);
		$article->delete();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

}
