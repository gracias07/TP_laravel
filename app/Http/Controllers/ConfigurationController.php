<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Http\Requests\StoreConfigRequest;
use Exception;

class ConfigurationController extends Controller
{
    //
    public function index(){
        $allConfigurations = Configuration::latest()->paginate(10);
        return view('config/index', compact('allConfigurations'));
    }

    public function create(){
        return view('config/create');
    }
    public function store(StoreConfigRequest $request){
        try{
            Configuration::create($request->all());
            return redirect()->route('configurations')->with('success_message', 'Configuration ajoutée');
        }catch(Exception $e){
            dd($e);
            //return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            throw new Exception('Erreur lors de l\'enregistrement de la configuration');
        }
    }

    public function delete(Configuration $configuration)
    {
        try {
            $configuration->delete();
            return redirect()->route('configurations')->with('success_message', 'Configuration supprimée');
        } catch (Exception $e) {
            return redirect()->route('configurations')->withErrors('Erreur lors de la suppression de la configuration');
        }
    }
}
