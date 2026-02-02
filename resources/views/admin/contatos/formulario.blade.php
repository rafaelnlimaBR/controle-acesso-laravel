<div class="col-md-6">
    <!--begin::Different Height-->
    <div class="card card-secondary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title">Contatos</div></div>
        <!--end::Header-->
        <!--begin::Body-->
        <form action="{{$route_form}}" method="post">
        {{csrf_field()}}
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row g-3">
                <!--begin::Col-->

                    <div class="col-md-3">
                        <label  class="form-label">Número<span class="sr-only"> </span></label>
                        <input type="text" class="form-control" name="numero" value="{{isset($numero)?$numero:old('numero',isset($contato)?$contato->numero:'')}}" >
                        @error('numero')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-5">
                        <label class="form-label">Observações<span class="required-indicator sr-only"> </span></label>
                        <input type="text" class="form-control" name="observacao"  >
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Observações<span class="required-indicator sr-only"> </span></label>
                        <div class="form-check">
                            <input class="form-check-input" name="whatsapp" type="checkbox" >
                            <label class="form-check-label" >
                                Whatsapp
                            </label>

                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Adicionar<span class="required-indicator sr-only"> </span></label>
                        <button type="text" class="form-control btn btn-success" name="nome_completo" value="{{isset($nome_completo)?$nome_completo:old('nome_completo',isset($usuario)?$usuario->nome_completo:'')}}" ><i class="bi bi-plus-circle-fill"></i></button>
                    </div>


            </div><br>

            <div class="row g-3">
                <table class="table table-bordered" role="table">
                    <thead>
                    <tr>
                        <th style="width: 20%" scope="col">Número</th>
                        <th scope="col">Apps</th>
                        <th style="width: 15%" scope="col">Whatsapp</th>
                        <th style="width: 5%" scope="col">Ações</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contatos as $contato)
                        <tr class="align-middle">
                            <td>{{$contato->numero}}</td>

                            <td>{{$contato->pivot->observacao}}</td>
                            <td>
                                @if($contato->pivot->whatsapp == 1)
                                    <i class="bi bi-whatsapp text-success"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{$route_delete.'?contato='.$contato->id}}" class="text-danger" onclick="return confirm('Deseja excluir esse registro?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>


                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!--end::Row-->
        </div>
        </form>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">

        </div>
        <!--end::Footer-->

        <!--end::Body-->
    </div>
    <!--end::Different Height-->
    <!--begin::Different Width-->

    <!--end::Different Width-->
    <!--begin::Form Validation-->
    <!--end::Form Validation-->
</div>
