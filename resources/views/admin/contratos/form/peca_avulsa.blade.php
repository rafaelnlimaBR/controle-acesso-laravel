<form name="adicionar-peca-avulsa" id="adicionar-peca-avulsa" action="{{route('contrato.pecaavulsa.adicionar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" method="post">
    <div class="row">
        <div class="col-md-3">
            {{ csrf_field() }}
            <label  class="form-label">Nome da Peça</label>

            <input class="form-control" name="nome" value="{{isset($nome)?$nome:''}}">
            @error('nome')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-2">

            <label  class="form-label">Marca</label>

            <input  name="marca" class="form-control"  id="marca" value="{{isset($marca)?$marca:''}}">

        </div>
        <div class="col-md-2">

            <label  class="form-label">Valor</label>

            <input  name="valor" class="form-control" value="{{isset($valor)?$valor:''}}">
            @error('valor')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-2">

            <label  class="form-label">Desconto</label>

            <input  name="desconto" class="form-control"  value="{{isset($desconto)?$desconto:''}}">
            @error('desconto')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-md-1">

            <label  class="form-label">Cobrar</label>

            <select name="cobrar" class="form-control">
                @if($historico_selecionado->status->cobrar == 1)
                    <option selected value="{{$historico_selecionado->status->cobrar}}">Sim</option>
                    <option value="{{$historico_selecionado->status->cobrar}}">Não</option>
                @else
                    <option selected value="{{$historico_selecionado->status->cobrar}}">Não</option>
                    <option  value="{{$historico_selecionado->status->cobrar}}">Sim</option>
                @endif
            </select>

        </div>

        <div class="col-md-1">
            <label  class="form-label">Adicionar</label>
            <button type="submit" class="btn btn-primary form-control">.</button>
        </div>
    </div>
</form>
