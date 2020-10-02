<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\LocalRequest;

use App\User;
use App\Member;
use App\Local;

use App\Inventory;
use App\Offer;

use App\Util\ImageHelper;
use Carbon\Carbon;

use Config;
use Auth;
use DB;
use View;
use File;


class LocalController extends AdminController {

    public $module_params;

    public function __construct()
    {
        $page = Request::get('page');
        $this->module_params = '?company_id='.Request::get('company_id');

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
        $filter = Request::get('filter');
        $company_id = Request::get('company_id');

        $locals = Local::select()
            ->where(function($query) use($company_id, $filter){
                if(!empty($company_id)) $query->where('company_id', $company_id);
                if(!empty($filter)) $query->where('name', 'LIKE', '%'.str_replace('', '%', $filter).'%');
            })
            ->Paginate()
            ->appends([
                'company_id'=>$company_id
            ]);

        View::share('filter', $filter);
        View::share('company_id', $company_id);
        
        return view('admin.local.index', array('locals'=>$locals));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $local=new Local(Request::all());

        return view('admin.local.create', compact('local'));
    }

    /**
     * Local a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LocalRequest $request)
    {
        $local = new Local();
        $local->fill($request->all());

        $metadata = $request->metadata;
        if(isset($metadata['upload_photo']) && !empty($metadata['upload_photo'])){
            $metadata['photo']=$this->upload_photo($metadata, $local->company);
        }
        if(isset($metadata['upload_cover']) && !empty($metadata['upload_cover'])){
            $metadata['cover']=$this->upload_cover($metadata, $local->company);
        }

        $local->metadata = $metadata;
        $local->save();

        $offers = $request->offers;

        if(is_array($offers)){
            foreach ($offers as $offer) {
                if(empty($offer['product_id'])) continue;
                Offer::create(['local_id'=>$local->id, 'product_id'=>$offer['product_id'], 'discount'=>$offer['discount'], 'active'=>true]);
            }
        }

        \App\Util\RegisterLog::add($local);
        return redirect('admin/local/'.$this->module_params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $local = Local::FindOrFail($id);

        return view('admin.local.show', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $local = Local::FindOrFail($id);

        return view('admin.local.edit', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(LocalRequest $request, $id)
    {
        $local = Local::FindOrFail($id);

        $metadata = $request->metadata;
        if(isset($metadata['upload_photo']) && !empty($metadata['upload_photo'])){
            $metadata['photo']=$this->upload_photo($metadata, $local->company);
        }
        if(isset($metadata['upload_cover']) && !empty($metadata['upload_cover'])){
            $metadata['cover']=$this->upload_cover($metadata, $local->company);
        }

        $local->fill($request->all());
        $local->metadata = $metadata;
        $local->save();

        $offers = $request->offers;

        if(is_array($offers)){

            Offer::whereNotIn('id', array_column($offers, 'id'))
                ->where('local_id', $local->id)->delete();

            foreach ($offers as $offer) {
                if(empty($offer['product_id'])) continue;
                if(empty($offer['id']))
                    Offer::create(['local_id'=>$local->id, 'product_id'=>$offer['product_id'], 'discount'=>$offer['discount'], 'active'=>true]);
                else
                    Offer::where('id', $offer['id'])
                        ->update(['product_id'=>$offer['product_id'], 'discount'=>$offer['discount'], 'active'=>true]);
            }
        }

        \App\Util\RegisterLog::add($local);
        return redirect('admin/local/'.$this->module_params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $local = Local::FindOrFail($id);
        $local->delete();

        \App\Util\RegisterLog::add($local);
        return redirect('admin/local/'.$this->module_params);
    }

    private function upload_photo($metadata, $company){

        $path_upload = upload_base_path();

        if (\Validator::make(Request::all(), ['metadata[upload_photo]' => Config::get('constants.mime_image')])->fails()) {
            return false;
        }

        $metadata_image = get_field($metadata, 'photo');
        $file= get_field($metadata, 'upload_photo');
        $extension = $file->getClientOriginalExtension();
        $filename = $company->id.'_'.uniqid().'.'.$extension;
        $image = 'company/photo/'.$filename;

        if(!ImageHelper::resize($file, $image, 260, 230)){
            return null;
        }

        if($metadata_image!=$image && file_exists($path_upload.$metadata_image)){
            File::delete($path_upload.$metadata_image);
        }

        return $image;
    }

    private function upload_cover($metadata, $company){

        $path_upload = upload_base_path();

        if (\Validator::make(Request::all(), ['metadata[upload_cover]' => Config::get('constants.mime_image')])->fails()) {
            return false;
        }

        $metadata_image = get_field($metadata, 'cover');
        $file= get_field($metadata, 'upload_cover');
        $extension = $file->getClientOriginalExtension();
        $filename = $company->id.'_'.uniqid().'.'.$extension;
        $image = 'company/cover/'.$filename;

        if(!ImageHelper::resize($file, $image, 1099, 330)){
            return null;
        }

        if($metadata_image!=$image && file_exists($path_upload.$metadata_image)){
            File::delete($path_upload.$metadata_image);
        }

        return $image;
    }

}
