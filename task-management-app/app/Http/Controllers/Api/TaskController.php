<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("Melihat Task");
        $Data=Task::latest()->paginate(5);
        return new TaskResource(true,"data task",$Data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("Menyimpan Task");
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("Melihat Task");
        $show= Task::find(id: $id);
        return new TaskResource(true, "data berhasil", $show);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize("Mengubah Task");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize("Menghapus Task");
        $delete= Task::find($id);
        $delete->delete();
        return new TaskResource(true, "data dihapus", $delete);
    }
}
