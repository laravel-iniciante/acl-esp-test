<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\Role;
use Hash;

class UserController extends Controller
{

    use \App\Traits\UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Gate::denies('user.list')) {
        //     abort(403);
        // }

        $users = User::
                // callInputScopes(['name' => 'filter.nome', 'email' => 'filter.email', 'roles' => 'filter.role', 'status' => 'filter.status' ])

                sortable(['id','asc'])
                ->select(
                    'users.name',
                    'users.remember_token',
                    'users.id','users.status',
                    'users.email',
                    \DB::raw("group_concat(roles.label SEPARATOR ' - ') as perms")
                )
                ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
                ->groupBy('users.id')
                ->applyFilters( \Config::get('dashboard.user.filter') )
                ->paginate(25);

        $roles = Role::orderBy('label', 'asc')->get();

        return view('dashboard.user.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Gate::denies('user.create')) {
            abort(403);
        }

        if (\Auth::user()->can('user.list')){
            echo 'can list';
        }



        $user = new User;
        $roles = Role::orderBy('label', 'asc')->get();
        $selectedRoles = [];
        return view("dashboard.user.create", compact('user','roles','selectedRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Gate::denies('user.create')) {
            abort(403);
        }

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|same:confirm-password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->roles()->sync( $request->role );
        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);

        if (Gate::denies('user.update')) {
            abort(403);
        }

        $this->authorize('update', $user);


        $user = User::findOrFail($id);
        $roles = Role::orderBy('label', 'asc')->get();

        $selectedRoles = $user->roles()->get()->toArray();
        $selectedRoles = array_pluck($selectedRoles, 'id');

        $generos = (object)[
            ['label' => 'Masculino','value' =>  'm'], 
            ['label' => 'Feminino', 'value' =>  'f']
        ];


        return view("dashboard.user.edit", compact('user','roles','selectedRoles','generos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Gate::denies('user.update')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $validateRules = [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $id,
        ];

        if( $request->password ){
            $validateRules['password'] = 'required|same:confirm-password';
        }

        $data = $this->validate($request, $validateRules);

        $user->fill($data);

        $user = $this->configUpload(\Config::get('dashboard.user.user_photo'))
                     ->fillUpload($user,'uniq');

        $user->save();
        $user->roles()->sync( $request->role );

        $request->session()->flash('success', 'Alterado com sucesso!');
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode('-', $id);
        User::whereIn('id', $ids)->delete();
        \Request::session()->flash('success', 'Excluido com sucesso!');
        return redirect()->route('user.index');
    }
}
