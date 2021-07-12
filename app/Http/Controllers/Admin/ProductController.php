<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\ProductRequest;

use App\Models\Product;
use App\Util\ImageHelper;
use Carbon\Carbon;

use View;
use Config;
use File;

class ProductController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $filter = Request::has('filter')? Request::input('filter'): NULL;

        $products = Product::select()
            ->where('name', 'LIKE', '%'.$filter.'%')
            ->Paginate();

        View::share('filter', $filter);
        
        return view('admin.product.index', array('products'=>$products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $product=new Product(Request::all());
        $product->active = '1';

        return view('admin.product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $metadata = $request->metadata;

        if($request->files->get('upload_photos')){
            $metadata['photos']= $this->upload_photo($metadata, $request);
        }

        $product->metadata = $metadata;
        $product->active = $request->active;
        $product->save();

        \App\Util\RegisterLog::add($product);
        return redirect('admin/product/');
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
        $product = Product::FindOrFail($id);

        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::FindOrFail($id);
        $product->fill($request->all());
        $metadata = $request->metadata;

        if($request->files->get('upload_photos')){
            $metadata['photos']= $this->upload_photo($metadata, $request);
        }

        $product->metadata = $metadata;
        $product->active = $request->active;
        $product->save();

        \App\Util\RegisterLog::add($product);
        return redirect('admin/product/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::FindOrFail($id);
        $product->delete();

        \App\Util\RegisterLog::add($product);
        return redirect('admin/product/');
    }

    private function upload_photo($metadata, $request){

        $path_upload = base_path().'/public/userfiles/';
        $photos=get_field($metadata, 'photos');
        $upload=$request->files;

        if (\Validator::make($request->all(), ['upload_photos[]' => Config::get('constants.mime_image')])->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors([
                    'upload_photos[]' => transl('No ha ingresado una foto válida (jpg, png, gif)'),
                ]);
        }

        if(is_array($photos))
            foreach($photos as $photo){
                if(file_exists($path_upload.$photo)){
                    File::delete($path_upload.$photo);
                }
            }

        $photos=[];
        foreach($upload->get('upload_photos') as $file){

            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = uniqid().'.'.$extension; //renameing image
            $photo = 'product/photos/'.$filename;

        if(!ImageHelper::resize($file, $photo, 260, 209)){
                return redirect()->back()
                    ->withInput($request->all())
                    ->withErrors([
                        'metadata[photos]' => transl('No se ha logrado cargar la imagen'),
                    ]);
            }

            $photos[]=$photo;
        }

        return $photos;
    }

}
