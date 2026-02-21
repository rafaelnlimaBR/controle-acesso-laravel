
    {{csrf_field()}}
    @if(isset($modal))
        <input name="modal" value="1" hidden="" >
    @endif
    <!--begin::Body-->

        <!--begin::Row-->
        <div class="row g-3">
            <!--begin::Col-->
            <div class="col-md-2">
                <label  class="form-label">Ativo<span class="sr-only"> </span></label>
                <select  class="form-control" name="ativo"  >
                    @if(isset($usuario))
                        @if($usuario->ativo == 1)
                            <option value="1" selected>Sim</option>
                            <option value="0">Não</option>
                        @else
                            <option value="1" >Sim</option>
                            <option value="0" selected>Não</option>
                        @endif
                    @else
                        <option value="1" selected>Sim</option>
                        <option value="0">Não</option>
                    @endif
                </select>

            </div>
            <div class="col-md-10">
                <label  class="form-label">Nome Completo<span class="required-indicator sr-only"> </span></label>
                <input type="text" class="form-control" name="nome_completo" value="{{isset($name)?$name:old('name',isset($usuario)?$usuario->name:'')}}" >
                @error('nome_completo')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>
        </div>
        <div class="row">
            <!--end::Col-->
            <!--begin::Col-->
            @if(isset($grupo_selecionado))
                <input value="{{$grupo_selecionado}}" name="grupos[]" hidden="">
            @else
            <div class="col-md-4">

                <label  class="form-label">Grupos <span class="required-indicator sr-only"> </span></label>

                    <select   class="form-control"  name="grupos[]" multiple size="1">
                        @foreach($grupos as $grupo)
                            @if(isset($usuario))
                                @if($usuario->grupos->contains('id',$grupo->id))
                                    <option value="{{$grupo->id}}"  selected>{{$grupo->nome}}</option>
                                @else
                                    <option value="{{$grupo->id}}" >{{$grupo->nome}}</option>
                                @endif
                            @else
                                <option value="{{$grupo->id}}">{{$grupo->nome}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('grupos')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
            </div>
            @endif
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4">

                <label  class="form-label">Email<span class="required-indicator sr-only"> </span></label>
                <input type="text" class="form-control"  name="email" value="{{isset($email)?$email:old('email',isset($usuario)?$usuario->email:'')}}">
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            @if(!isset($usuario))
                <div class="col-md-3">

                    <label  class="form-label">Senha<span class="required-indicator sr-only"> </span></label>
                    <input type="password" class="form-control"  name="senha" value="{{isset($modal)?123456:''}}">
                    @error('senha')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            @endif



            @if(!isset($usuario))

                <div class="col-md-3">

                    <label  class="form-label">Contato<span class="required-indicator sr-only"> </span></label>
                    <input type="text" class="form-control"  name="contato" value="{{isset($contato)?$contato:old('contato')}}">
                    @error('contato')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">APP<span class="required-indicator sr-only"> </span></label>
                    <div class="form-check">
                        <input class="form-check-input" name="whatsapp" type="checkbox" >
                        <label class="form-check-label" >
                            Whatsapp
                        </label>

                    </div>
                </div>
            @endif



        </div>
        <!--end::Row-->

    <!--end::Body-->
    <!--begin::Footer-->

    <!--end::Footer-->

