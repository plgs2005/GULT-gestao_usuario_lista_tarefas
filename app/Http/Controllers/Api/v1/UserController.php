<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUsersFormRequest;
use App\Mail\newEmailGult;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use stdClass;

class UserController extends Controller
{

    private $user, $totalPages = 10;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth:api')->except([
            'index', 'show'
        ]);
    }

    public function sendemail($id)
    {
        $user = Auth::user();

        $user = new stdClass(); //
        $user->name = Auth::user()->name;
        $user->email = Auth::user()->email;
        $user->request = $this->show($id);

        //return new newEmailGult($user);
        Mail::send(new newEmailGult($user));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $request)
    {
        $user = $this->user->create($request->all());

        $this->sendemail($user->id);


        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$user = $this->user->find($id))
            return response()->json(['error' => 'Usuario nao encontrado! ou Apagado com Sucesso'], 404);

        return response()->json($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUsersFormRequest $request, $id)
    {
        if (!$user = $this->user->find($id))
            return response()->json(['error' => 'Usuário não encontrado!'], 404);

        $user->update($request->all());
        $this->sendemail($user->id);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$user = $this->user->find($id))
            return response()->json(['error' => 'Tarefa não encontrada!'], 404);

        $user->delete($request->all());
        $this->sendemail($user->id);

        return response()->json(['SUCCESS' => true], 204);
    }
}
