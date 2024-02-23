<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogbookpetirRequest;
use App\Http\Requests\UpdateLogbookpetirRequest;
use App\Models\LogbookPetir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LogbookpetirController extends Controller
{
    public function index(Request $request){

        $logbookpetirs = DB::table('logbook_petirs')
            ->when($request->input('search'), function ($query, $search){
                return $query->where('onduty1', 'like', '%' . $search . '%') 
                -> orWhere ('onduty2', 'like', '%' . $search . '%')
                -> orWhere ('onduty3', 'like', '%' . $search . '%')
                -> orWhere ('kehadiran', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.logbookpetir.index', compact('logbookpetirs'));
    }


    public function create(){
        return view('pages.logbookpetir.create',  ['type_menu' => '']);
    }

    public function store(StoreLogbookpetirRequest $request){
        $data = $request->all();
        LogbookPetir::create($data);
        return redirect()->route('logbookpetir.index')->with('success', 'Data Logbook Petir Successfully Created');
    }

    public function edit($id){
        $logbookpetir = LogbookPetir::findOrFail($id);
        return view('pages.logbookpetir.edit', compact('logbookpetir'),  ['type_menu' => '']);
    }

    public function show($id){
        $logbookpetir = LogbookPetir::findOrFail($id);
        return view('pages.logbookpetir.show', compact('logbookpetir'),  ['type_menu' => '']);
    }

    public function update(UpdateLogbookpetirRequest $request, LogbookPetir $logbookpetir){
        $data = $request->validated();
        $logbookpetir->update($data);
        return redirect()->route('logbookpetir.index')->with('success', 'logbookpetir Successfully Updated');
    }
   

    public function destroy(LogbookPetir $logbookpetir){
        $logbookpetir->delete();
        return redirect()->route('logbookpetir.index')->with('success', 'Data Logbook Petir Successfully Deleted');
        
    }
}
