<form name="adicionar-servico" id="adicionar-servico" action="{{route('contrato.servico.adicionar',['contrato'=>$contrato,'historico'=>$historico_selecionado])}}" method="post">
    <div class="row">
        <div class="col-md-3">
            {{ csrf_field() }}
            <label  class="form-label">Serviço</label>

            <select required name="servico" class="form-control " id="pesquisa-servico">

            </select>
            @error('servico')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-2">
            {{ csrf_field() }}
            <label  class="form-label">Valor</label>

            <input required name="valor" class="form-control" value="0" id="valor_servico">
            @error('valor')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-md-1">
            {{ csrf_field() }}
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
            @error('valor')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-md-1">
            <label  class="form-label">Adicionar</label>
            <button type="submit" class="btn btn-primary form-control">.</button>
        </div>
    </div>
</form>
