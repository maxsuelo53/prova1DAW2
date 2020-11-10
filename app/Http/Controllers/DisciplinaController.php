<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplina = new Disciplina();
        $disciplinas = Disciplina::All();

        return view("disciplina.index",[
            "disciplina" => $disciplina,
            "disciplinas" => $disciplinas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validacao = $request->validate([
            "nome"=>"required",
            "maximo_faltas"=> "required|numeric"
        ],[
            "*.required"=>"(:attribute) é obrigatório!"
        ]);

        if($request->get("id")==""){
            $disciplina = new Disciplina();
            $disciplina->total_faltas = 0;
		}else {
            $disciplina = Disciplina::find($request->get("id"));
        }
        $disciplina->nome = $request->get("nome");
        $disciplina->maximo_faltas = $request->get("maximo_faltas");
        $disciplina->save();

        $request->Session()->flash("salvar","Jogador salvo com sucesso!");
        
        return redirect("/disciplina");
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
        $disciplina = Disciplina::find($id);
        $disciplinas = Disciplina::All();

        return view("disciplina.index",[
            "disciplina" => $disciplina,
            "disciplinas" => $disciplinas
        ]);
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
        $disciplina = Disciplina::find($id);
        $disciplina->total_faltas++;
        $disciplina->save();

        return redirect("/disciplina");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Disciplina::destroy($id);

        $request->Session()->flash("excluir","Jogador excluido com sucesso!");
		return redirect("/disciplina");
    }

}
