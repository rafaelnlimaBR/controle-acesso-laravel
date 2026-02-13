
    {{csrf_field()}}
    <!--begin::Body-->

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
                    <select class="form-control" name="modelo" id="pesquisa-montadora">
                       {{-- @foreach($modelos as $modelo)
                            <option value="{{$modelo->id}}">{{$modelo->nome}}</option>
                        @endforeach--}}
                    </select>
                @error('modelo')
                <div class="invalid-feedback">{{@$message}}</div>
                @enderror
            </div>

        </div>

        <!--end::Row-->

    <!--end::Body-->
    <!--begin::Footer-->

    <!--end::Footer-->

