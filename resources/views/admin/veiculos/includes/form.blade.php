<form class="needs-validation" novalidate="" method="post" action="{{isset($veiculo)?route('veiculo.atualizar',['veiculo'=>$veiculo]):route('veiculo.cadastrar')}}">
    {{csrf_field()}}
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row g-3">
            <!--begin::Col-->
            <div class="col-md-4">
                <label  class="form-label">Placa<span class="sr-only"> </span></label>
                <input type="text" class="form-control" name="placa" value="{{isset($placa)?$placa:old('placa',isset($veiculo)?$veiculo->placa:'')}}" >
                @error('placa')
                <div class="invalid-feedback">{{@$message}}</div>
                @enderror
            </div>
            <div class="col-md-2">
                <label  class="form-label">Ano<span class="sr-only"> </span></label>
                <input type="text" class="form-control" name="ano" value="{{isset($ano)?$ano:old('ano',isset($veiculo)?$veiculo->ano:'')}}" >
                @error('ano')
                <div class="invalid-feedback">{{@$message}}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label  class="form-label">Cor<span class="sr-only"> </span></label>
                <input type="text" class="form-control" name="cor" value="{{isset($cor)?$cor:old('cor',isset($veiculo)?$veiculo->cor:'')}}" >
                @error('cor')
                <div class="invalid-feedback">{{@$message}}</div>
                @enderror
            </div>

            <div class="col-md-3">
                <label  class="form-label">Cor<span class="sr-only"> </span></label>
                    <select class="form-control" name="modelo">
                        @foreach($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{$modelo->nome}}</option>
                        @endforeach
                    </select>
                @error('modelo')
                <div class="invalid-feedback">{{@$message}}</div>
                @enderror
            </div>

        </div>

        <!--end::Row-->
    </div>
    <!--end::Body-->
    <!--begin::Footer-->
    <div class="card-footer">
        @if(isset($veiculo))
            <button class="btn btn-warning" type="submit">Editar</button>
            @can('veiculo-deletar')
                <a href="{{route('veiculo.excluir',['veiculo'=>$veiculo])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
            @endcan
        @else
            <button class="btn btn-success" type="submit">Cadastrar</button>
        @endif

        <a href="{{route('veiculo.index')}}" class="btn btn-dark" type="submit">Voltar </a>
    </div>
    <!--end::Footer-->
</form>
