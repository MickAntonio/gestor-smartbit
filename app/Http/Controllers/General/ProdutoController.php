<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administrador\Produtos;
use App\Models\General\Fornecedores;
use App\Models\General\Categorias;
use App\Models\General\SubCategorias;
use App\Models\Administrador\Estoques;
use App\Models\Administrador\ProdutoVariacoes;
use App\Models\General\TipoAtributos;
use App\Models\General\Atributos;
use Session;
use Image;
use Illuminate\Support\Collection;
use PDF;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.produtos.index')->withProdutos(Produtos::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.produtos.create')->withCategorias(Categorias::all())->withFornecedores(Fornecedores::all())->withTipoAtributos(TipoAtributos::all())->withAtributos(Atributos::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'nome'=>'required',
            'subcategoria_id'=>'required',
            'valor_compra'=>'required',
        ));

        $produto = new Produtos;

        $produto->nome            = $request->nome;
        $produto->codigo          = $request->codigo;
        $produto->modelo          = $request->modelo;
        $produto->dimensoes       = $request->dimensoes;
        $produto->peso            = $request->peso;
        $produto->valor_compra    = $request->valor_compra;
        $produto->despesas        = $request->despesas;
        $produto->valor_venda     = $request->valor_venda;
        $produto->subcategoria_id = $request->subcategoria_id;
        $produto->fornecedor_id   = $request->fornecedor_id;
        $produto->variacao        = $request->variacao;
        $produto->comercial       = $request->comercial;

        if($request->hasFile('imagem'))
        {
            
            $image = $request->file('imagem');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $location = public_path('img/produtos/' . $filename);

            Image::make($image)->save($location);

            $produto->imagem = $filename;

        }else{
            $produto->imagem = 'default.jpg';
        }

        $produto->save();

        // Tratando do Estoque
        
        if($request->variacao=='Nao'){
            // Adicionar Estoque
            $estoque = new Estoques;
        
            $estoque->estoque_minimo = $request->estoque_minimo_sem_variacao;
            $estoque->estoque_maximo = $request->estoque_maximo_sem_variacao;
            $estoque->estoque_actual = $request->estoque_actual_sem_variacao;

            $estoque->produto_id = $produto->id;

            $estoque->save();

        }else{

            for ($i=0; $i < collect($request->estoque_minimo)->count(); $i++) { 

                // Adicionar Estoque
                $estoque = new Estoques;
            
                $estoque->estoque_minimo = $request->estoque_minimo[$i];
                $estoque->estoque_maximo = $request->estoque_maximo[$i];
                $estoque->estoque_actual = $request->estoque_actual[$i];
                $estoque->produto_id     = $produto->id;

                $estoque->save();

               foreach ($request->atributos as $value) {
                    // Adicionar Variações do Produto
                    $produtoVariacao = new ProdutoVariacoes;

                    $produtoVariacao->estoque_id  = $estoque->id;
                    $produtoVariacao->atributo_id = $value[$i];

                    $produtoVariacao->save(); 
                }

            }

        }


        Session::flash('successo', 'Produto Adicionada com Successo');

        return redirect()->route('produtos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('general.produtos.show')->withProduto(Produtos::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('general.produtos.edit')->withProduto(Produtos::find($id))
                                            ->withCategorias($this->converto(Categorias::all(), "id", "nome"))
                                            ->withSubCategorias($this->converto(SubCategorias::all(), "id", "nome"))
                                            ->withFornecedores($this->converto(Fornecedores::all(), "id", "nome"));
    }

    /**
     * convert an list with many atributes to a list with one atribuite identified by index.
     *
     * @param  array  $list
     * @param  int or string the identifier
     * @param  string or int the only atributes that must stay 
     * @return array
     */
    public function converto($list, $index, $name)
    {
        $result = [];
        foreach($list as $value){
            $result[$value[$index]] = $value[$name];
        }

        return $result;
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
        $this->validate($request, array(
            'nome'=>'required',
            'subcategoria_id'=>'required',
            'valor_compra'=>'required',
        ));

        $produto = Produtos::find($id);

        $produto->nome            = $request->nome;
        $produto->codigo          = $request->codigo;
        $produto->modelo          = $request->modelo;
        $produto->dimensoes       = $request->dimensoes;
        $produto->peso            = $request->peso;
        $produto->valor_compra    = $request->valor_compra;
        $produto->despesas        = $request->despesas;
        $produto->valor_venda     = $request->valor_venda;
        $produto->subcategoria_id = $request->subcategoria_id;
        $produto->fornecedor_id   = $request->fornecedor_id;
        $produto->variacao        = $request->variacao;
        $produto->comercial       = $request->comercial;

        if($request->hasFile('imagem'))
        {
            
            $image = $request->file('imagem');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $location = public_path('img/produtos/' . $filename);

            Image::make($image)->save($location);

            $produto->imagem = $filename;

        }

        $produto->save();
        
        // // Adicionar Variações do Produto
        // $produtoVariacao = new ProdutoVariacao;

        // $produtoVariacao->referencia  = $request->referencia;
        // $produtoVariacao->produto_id  = $produto->id;
        // $produtoVariacao->atributo_id = $request->atributo_id;

        // $produtoVariacao->save();        

        // Adicionar Estoque
        $estoque = Estoques::find($request->estoque_id);
        

        $estoque->estoque_minimo = $request->estoque_minimo;
        $estoque->estoque_maximo = $request->estoque_maximo;
        $estoque->estoque_actual = $request->estoque_actual;

        if($request->variacao=='Sim'){
            $estoque->referencia = $produtoVariacao->referencia;
        }

        $estoque->save();

        Session::flash('successo', 'Produto Actualizado com Successo');

        return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Estoques::where('produto_id', $id)->delete();
        Produtos::find($id)->delete();
        
        Session::flash('successo', 'Produto Excluida com Successo');
        return redirect()->route('produtos.index');
    }

    /**
     * Return a list of objects in json format
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jsonListaDeProdutos()
    {
        return json_encode( Produtos::all() );
    }

    /**
     * Return a list of objects in json format
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jsonProduto($id)
    {
        return json_encode( Produtos::find($id) );
    }

      /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfLista()
    {
        $pdf = PDF::loadView('general.produtos.pdf.lista',  $data=["produtos"=>Produtos::all()]);
        return $pdf->stream('produtos.pdf');
    }
}
