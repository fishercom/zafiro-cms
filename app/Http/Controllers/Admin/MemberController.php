<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\MemberRequest;

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


class MemberController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $filter = Request::has('filter')? Request::input('filter'): NULL;
        //if(empty($filter)) $filter=str_replace($filter, ' ', '%');

        $members=Member::join('users', function($join) use($filter) {
                $join->on('members.user_id', '=', 'users.id');
            })
            ->select('members.id', 'members.user_id', 'users.name', 'users.lastname', 'users.email', 'members.document', 'users.active', 'document_type', 'members.status', 'members.created_at', 'members.updated_at')
            ->where(function($query) use($filter){
                $query->where('name', 'LIKE', '%'.$filter.'%');
                $query->orWhere('lastname', 'LIKE', '%'.$filter.'%');
            })
            ->where('member_type', 'CLIENT')
            ->orderBy('lastname', 'asc')
            ->Paginate();


        View::share('filter', $filter);

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $member = new Member(Request::all());
        $user = new User(Request::all());

        return view('admin.member.create', compact('member', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MemberRequest $request)
    {
        $validator = Validator::make(Request::all(), [
            'name' => 'required', 'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput(Request::all())
                ->withErrors($validator);
        }

        $user = User::Create($request->all());
        $user->fill($request->all());

        $member = new Member();
        $member->fill($request->all());
        $member->user_id = $user->id;

        $metadata = $request->metadata;
        if(isset($metadata['photo']) && !empty($metadata['photo'])){
            $user->photo = $this->upload_photo($metadata, $user);
            $metadata['photo']=$user->photo;
        }

        $member->metadata = $metadata;
        $member->member_type='CLIENT';
        $member->save();

        //TODO: Verify confirmation by mail
        //$user->sendEmailVerificationNotification();

        $user->is_member=true; //From Constants
        $user->active=true;
        $user->save();

        if(!empty($member->company_name)) Company::create(['member_id'=>$member->id, 'name'=>$member->company_name, 'country_id'=>$member->country_id]);

        //if($request->has('sendmail')) $this->notify($member->user);

        \App\Util\RegisterLog::add($member);
        return redirect('admin/member/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $member = Member::FindOrFail($id);
        $user = $member->user;

        return view('admin.member.show', compact('member', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::FindOrFail($id);
        $user = $member->user;

        return view('admin.member.edit', compact('member', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(MemberRequest $request, $id)
    {
        $member = Member::FindOrFail($id);
        $member->fill($request->all());
        $user = $member->user;
        $metadata = $request->metadata;

        if(isset($metadata['upload']) && !empty($metadata['upload'])){
            $metadata['photo']=$this->upload_photo($metadata, $user);
        }

        $member->metadata = $metadata;
        $member->save();

        if($request->has('reset')){
            //DB::table('user_posts')->where('user_id', $id)->delete();
            //$member->created_at=Carbon::now();
        }

        //if($request->has('sendmail')) $this->notify($member->user);

        \App\Util\RegisterLog::add($member);
        return redirect('admin/member/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $member = Member::FindOrFail($id);
        $user = $member->user;
        $member->delete();
        $user->delete();

        \App\Util\RegisterLog::add($member);
        return redirect('admin/member/');
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


    private function upload_photo($metadata, $user){

        $path_upload = upload_base_path();

        if (\Validator::make(Request::all(), ['metadata[upload]' => Config::get('constants.mime_image')])->fails()) {
            return false;
        }

        $metadata_image = get_field($metadata, 'photo');
        $file= get_field($metadata, 'upload');
        $extension = $file->getClientOriginalExtension();
        $filename = $user->id.'_'.uniqid().'.'.$extension;
        $image = 'user/photo/'.$filename;

        if(!ImageHelper::resize($file, $image, 300, 300)){
            return null;
        }

        if($metadata_image!=$image && file_exists($path_upload.$metadata_image)){
            File::delete($path_upload.$metadata_image);
        }

        return $image;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function import(Request $request){
        $file = $request->file('file');
        $rules = array('file' => 'required|mimes:txt,csv'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('file'=> $file), $rules);
        //ini_set('max_execution_time', '600');
        set_time_limit(600);

        if($validator->passes()){
            $delimiter = $file->getClientOriginalExtension()=='txt'? "\t": ";";
            $csv = file_get_contents($file->getRealPath());

            //DB::table('users')->where('member', true)->update(array('active' => false)); //reset active users

            $rows = explode("\n", $csv);
            for($i = 1; $i< count($rows); $i++){
                if(empty($rows[$i])) continue;
                $cols = explode($delimiter, $rows[$i]);
                if(strlen($cols[2])<7) continue; // dni validation

                $lastname=html_entity_decode(htmlentities($cols[0], ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                $name    =html_entity_decode(htmlentities($cols[1], ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                $username=$cols[2];
                $password=!empty($cols[3])? $cols[3]: 'MAISBFC'; //Default Password
                $email=!empty($cols[4])? $cols[4]: $username.'@maisbfc.org.pe';
                $red_salud=html_entity_decode(htmlentities($cols[5], ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                $micro_red=html_entity_decode(htmlentities($cols[6], ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                $establecimiento=html_entity_decode(htmlentities($cols[7], ENT_QUOTES | ENT_IGNORE, "UTF-8"));
                $perfil = strtoupper(html_entity_decode(htmlentities($cols[8], ENT_QUOTES | ENT_IGNORE, "UTF-8")));
                // 2=>CONSOLIDADO Y ACCESO A REPORTES, 3=>REGISTRO DE INFORMACION Y ACCESO A REPORTES, 4=>REGISTRO DE INFORMACION
                $profile_id=$perfil=='REGISTRO DE INFORMACION Y ACCESO A REPORTES'? 3: ($perfil=='CONSOLIDADO Y ACCESO A REPORTES'? 2: 4);

                $user = Member::where('username', $username)->first();

                if(!$user){
                    Member::Create([
                        'name'=>$name,
                        'lastname'=>$lastname,
                        'username'=>$username,
                        'password'=>$password,
                        'email'=>$email,
                        'red_salud'=>$red_salud,
                        'micro_red'=>$micro_red,
                        'establecimiento'=>$establecimiento,
                        'profile_id'=>$profile_id,
                        'member'=>($profile_id==3 || $profile_id==4),
                        'active'=>true
                    ]);
                }
                else{
                    //if($user->active) continue;

                    $user->name     = $name;
                    $user->lastname = $lastname;
                    $user->red_salud = $red_salud;
                    $user->micro_red = $micro_red;
                    $user->establecimiento= $establecimiento;
                    $user->profile_id = $profile_id;
                    $user->member = ($profile_id==3 || $profile_id==4);
                    $user->active   = true;

                    $user->save();
                }
            }

            return response()->json(array('resp'=>1, 'msg'=>'La carga se realizó correctamente'));
        }

        return response()->json(array('resp'=>0, 'msg'=>'Error importando el archivo'));
    }

}
