<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTasksFormRequest;
use App\Mail\newEmailGult;
use Illuminate\Http\Request;
use App\Models\TasksList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use stdClass;

class TasksListController extends Controller
{
    private $list, $totalPages = 10;

    public function __construct(TasksList $list)
    {
        $this->list = $list;
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
        $list = $this->list->getResult($request->all(), $this->totalPages);
        return response()->json($list);
    }

    public function show($id)
    {

        if (!$list = $this->list->find($id))
            return response()->json(['error' => 'Tarefa nao encontrada! ou Apagada com Sucesso'], 404);

        return response()->json($list);
    }

    public function store(StoreUpdateTasksFormRequest $request)
    {
        $list = $this->list->create($request->all());

        $this->sendemail($list->id);
        

        return response()->json($list, 201);
    }

    public function update(StoreUpdateTasksFormRequest $request, $id)
    {

        if (!$list = $this->list->find($id))
            return response()->json(['error' => 'Tarefa não encontrada!'], 404);

        $list->update($request->all());
        $this->sendemail($list->id);
        return response()->json($list);
    }

    public function destroy(Request $request, $id)
    {
        if (!$list = $this->list->find($id))
            return response()->json(['error' => 'Tarefa não encontrada!'], 404);

        $list->delete($request->all());
        $this->sendemail($list->id);

        return response()->json(['SUCCESS' => true], 204);
    }
}
