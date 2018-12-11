<?php 

namespace App\Http\Controllers;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Caffeinated\Shinobi\Models\Role; 
use Illuminate\Support\Facades\Hash;
use Response;
use Image;
use App\User;


class UserController extends Controller
{
    protected $userRepository;
    protected $nbrPerPage = 5;

    /**
     * Create a new controller instance.
     * Constructeur
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /* Afficher le tableau de bord de l'administration */
    public function accueilUser()
    {
        return view('user/tableau-de-bord');
    }

    /**
     * Afficher la liste des utilisateurs
     * Appelle la méthode getPaginate de ResourceRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPaginate($this->nbrPerPage);
        $links = $users->render();
        return view('user/tous-les-utilisateurs', compact('users', 'links'));
    }    

    /* Envoyer le formulaire de la création d'un nouvel utilisateur */
    public function create(){
        return view('user/ajouter');
    }

    /* Enregistrer un nouvel utilisateur */
    public function store(UserCreateRequest $request){
        $user = $this->userRepository->store($request->all());
        return redirect('user/index');/*->with('status','créé') ou ->withOk("L'utilisateur " . $user->name . " a été créé.")*/
    }

    /* Afficher les informations sur un utilisateur */
    public function show($id)
    {
        $user = $this->userRepository->getById($id);

        return view('user/afficher-utilisateur',  compact('user'));
    }  

    /* Modifier un utilisateur */
    public function edit($id)
    {
        $roles = Role::get();
        $user = $this->userRepository->getById($id);
        return view('user/modifier-utilisateur',  compact('user','roles'));
    }

    /* Sauvegarder les modifications */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->getById($id);
        $this->userRepository->update($id, $request->all());
        $user->roles()->sync($request->get('roles'));
        return redirect('user/index');
    }

    /* Supprimer un utilisateur */
    public function destroy($id)
    {
        $this->userRepository->destroy($id);
        return redirect()->back();
    }

    /* Fonction qui permet d'afficher le profil d'un utilisateur */
    public function profil(){
        return view('user/profil', array('user' => Auth::user()));
    }

    public function profilUpdate(Request $request){
        
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->telephone = $request->input('telephone');
            
        $user->save();
        return view('user/profil', array('user' => Auth::user()));
    }

    /* Fonction qui permet de modifier le profil de l'utilisateur */
    public function userUpdateProfil(Request $request){
        if($request ->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $nom = str_random(10) . '.' . $filename;
            Image::make($photo)->resize(300,300)->save(public_path('/img/avatars/' . $nom));
            $user = Auth::user();
            $user->photo = $nom;
            $user->save();
        }
        return view('user/profil', array('user' => Auth::user()));
    }

    /* Fonction qui permet d'afficher le formulaire de modification du mot de passe */
    public function password(){
        return view('user/password');
    }

    // Fonction qui permet de modifier le mot de passe de l'utilisateur 
    public function changePassword(ChangePasswordRequest $request){

        $oldPassword = $request->input('oldPassword');
        $password = $request->input('password');

        if(Hash::check($oldPassword, Auth::user()->password))
            {
                $id = Auth::user()->id;
                $user = User::findOrFail($id);   
                $user->password = $password;
                $user->save();

               return back()->with('succes','mot de passe modifé.');
            }else
            {
               return back()->with('erreur','Le mot de passe saissie ne correspond pas.'); 
            }
    }
}
