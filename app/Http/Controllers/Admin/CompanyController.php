<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CompanyRequest;

use App\User;
use App\Member;
use App\Company;

use App\Util\ImageHelper;
use Carbon\Carbon;

use Config;
use Auth;
use DB;
use View;
use File;


class CompanyController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $filter = Request::has('filter')? Request::input('filter'): NULL;

        $companys = Company::select()
            ->where('name', 'LIKE', '%'.$filter.'%')
            ->Paginate();

        View::share('filter', $filter);
        
        return view('admin.company.index', array('companys'=>$companys));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $company=new Company(Request::all());
        $member=new Member(Request::all());
        $user=new User(Request::all());

        return view('admin.company.create', compact('company', 'member', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CompanyRequest $request)
    {
        $validator = Validator::make(Request::all(), [
            'name' => 'required', 'ruc' => 'required', 'password' => 'required', 'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput(Request::all())
                ->withErrors($validator);
        }

        $user = new User();
        $user->fill($request->user);
        $user->email=$request->email;
        $user->password=$request->password;
        $user->is_member=true;
        $user->save();

        $member = new Member();
        $member->fill($request->member);
        $member->user_id = $user->id;
        $member->member_type='COMPANY'; //From Constants
        $member->save();

        $company = new Company();
        $company->fill($request->all());
        $company->member_id = $member->id;

        $metadata = $request->metadata;
        $billingdata = $request->billingdata;

        if(isset($metadata['upload']) && !empty($metadata['upload'])){
            $metadata['logo']=$this->upload_logo($metadata, $company);
        }

        $company->metadata = $metadata;
        $company->billingdata = $billingdata;
        $company->save();

        \App\Util\RegisterLog::add($company);
        return redirect('admin/company/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $company = Company::FindOrFail($id);
        $user = $company->user;

        return view('admin.company.show', compact('company', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $company = Company::FindOrFail($id);
        $member = $company->member;
        $user = $member->user;

        return view('admin.company.edit', compact('company', 'member', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::FindOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'ruc' => 'required', 'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }

        $member = $company->member;
        $member->fill($request->member);
        $member->save();

        $user = $member->user;
        $user->fill($request->user);
        $user->email=$request->email;
        $user->save();

        $metadata = $request->metadata;
        $contact = $request->contact;
        $billingdata = $request->billingdata;

        if(isset($metadata['upload']) && !empty($metadata['upload'])){
            $metadata['logo']=$this->upload_logo($metadata, $company);
        }

        $company->fill($request->all());
        $company->metadata = $metadata;
        $company->billingdata = $billingdata;
        $company->verified = $request->verified;
        $company->save();

        \App\Util\RegisterLog::add($company);
        return redirect('admin/company/');
    }

    private function notify($user, Request $request){
        $from=array();
        $from['name'] = \App\CmsConfig::where('alias', 'site_name')->first()->value;
        $from['email'] = \App\CmsConfig::where('alias', 'postmaster')->first()->value;
        $passw = $request->input('password');

        Mail::send('emails.user', ['user' => $user, 'passw'=>$passw],
            function ($m) use ($user, $from) {
                $m->from($from['email'], $from['name']);
                $m->to($user->email)->subject('Programa de Reconocimiento - Nuevo Usuario');
        });
    }

    private function upload_logo($metadata, $company){

        $path_upload = upload_base_path();

        if (\Validator::make(Request::all(), ['metadata[upload]' => Config::get('constants.mime_image')])->fails()) {
            return false;
        }

        $metadata_image = get_field($metadata, 'logo');
        $file= get_field($metadata, 'upload');
        $extension = $file->getClientOriginalExtension();
        $filename = $company->id.'_'.uniqid().'.'.$extension;
        $image = 'company/logo/'.$filename;

        if(!ImageHelper::resize($file, $image, 300, 300)){
            return null;
        }

        if($metadata_image!=$image && file_exists($path_upload.$metadata_image)){
            File::delete($path_upload.$metadata_image);
        }

        return $image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $company = Company::FindOrFail($id);
        $company->delete();

        \App\Util\RegisterLog::add($company);
        return redirect('admin/company/');
    }

}
