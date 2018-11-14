<?php

namespace App\Http\Controllers;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $nbrPerPage = 5;

    /* Constructeur */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
    }
    /**
     * Fonction qui permet d'afficher la liste des rôles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getPaginate($this->nbrPerPage);
        $links = $roles->render();
        return view('role/tous-les-roles', compact('roles', 'links'));
    }

    /**
     * Fonction qui permet de créer un nouveau rôle.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('role/ajouter', compact('permissions'));
    }

    /**
     * Fonction qui permet d'enregistrer un rôle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $role = $this->roleRepository->store($request->all());
        $role->permissions()->sync($request->get('permissions'));
        return redirect('role');
    }

    /**
     * Fonction qui permet d'afficher un rôle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->getById($id);

        return view('role/afficher-role',  compact('role'));
    }

    /**
     * Fonction qui permet d'afficher le formulaire de modification des rôles.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->getById($id);
        $permissions = Permission::get();
        return view('role/modifier-role',  compact('role','permissions'));
    }

    /**
     * Fonction qui permet de modifier un rôle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = $this->roleRepository->getById($id);
        $this->roleRepository->update($id, $request->all());
        $role->permissions()->sync($request->get('permissions'));
        return redirect('role');
    }

    /**
     * Fonction qui permet de supprimer un rôle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->destroy($id);

        return redirect()->back();
    }
}
