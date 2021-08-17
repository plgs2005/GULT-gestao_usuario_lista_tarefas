<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateStatusFormRequest;
use App\Mail\newEmailGult;
use App\Models\TasksList;
use Illuminate\Http\Request;
use App\Models\TasksStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\This;
use stdClass;

class StatusController extends Controller
{
    private $status, $totalPages = 10;

    public function __construct(TasksStatus $status)
    {
        $this->status = $status;

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

    public function index(Request $request)
    {
        $status = $this->status->getStatus($request->name);
        return response()->json($status);
    }


    public function show($id)
    {

        if (!$status = $this->status->find($id))
            return response()->json(['Msg' => 'Status nao encontrado ou Apagado foi com sucesso!'], 404);

        return response()->json($status);
    }


    public function store(StoreUpdateStatusFormRequest $request)
    {
        $status = $this->status->create($request->all());

       $this->sendemail($status->id);

        return response()->json($status, 201);
    }

    public function update(StoreUpdateStatusFormRequest $request, $id)
    {

        if (!$status = $this->status->find($id))
            return response()->json(['error' => 'status não encontrado!'], 404);

        $status->update($request->all());

       
        $this->sendemail($id);

        return response()->json($status);
    }


    public function destroy(Request $request, $id)
    {

        if (!$status = $this->status->find($id))
            return response()->json(['error' => 'status não encontrado!'], 404);

        $status->delete($request->all());

        $this->sendemail($id);

        return response()->json(['SUCCESS' => true], 204);
    }



    public function tasks($id)
    {

        if (!$status = $this->status->find($id))
            return response()->json(['error' => 'status não encontrado!'], 404);


        $tasks = $status->list()->paginate($this->totalPages);


        return response()->json([
            'status' => $status,
            'tasks' => $tasks
        ]);
    }
}
