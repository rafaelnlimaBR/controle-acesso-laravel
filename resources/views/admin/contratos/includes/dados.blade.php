@if(isset($contrato))
    @if($proximos_status->count() > 0)
        <div class="card-header">
            <h4>Opções de Status</h4>
            @foreach($proximos_status as $proximo)
                <a status-id="{{$proximo->id}}" class="btn btn-app proximo-status botao-mudar-status" data-toggle="modal" data-target="#proximo-status" style="color: {{'#'.$proximo->cor_letra}}; background-color: {{'#'.$proximo->cor_fundo}}">{{$proximo->nome}}</a>
            @endforeach

        </div>
    @endif
@endif

<div class="row">
            <form class="needs-validation" novalidate="" method="post" action="{{isset($contrato)?route('contrato.atualizar',['contrato'=>$contrato,'historico'=>$historico_selecionado]):route('contrato.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            {{ csrf_field() }}
                            <label  class="form-label">Cliente<span class="sr-only"> </span><span id="editar-cliente"></span>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#formularioClienteModal"> Novo </button></label>
                            <select name="cliente" class="form-control " id="pesquisa-cliente">
                                @if(isset($contrato))
                                    <option value="{{$contrato->cliente->id}}">{{$contrato->cliente->name}}</option>
                                @endif
                            </select>
                            @error('cliente')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label  class="form-label">Veiculo<span class="sr-only"> </span><span id="editar-veiculo"></span>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#formularioVeiculoModal"> Novo </button></label>
                            <select  name="veiculo" class="form-control " id="pesquisa-veiculo">
                                @if(isset($contrato))
                                    @if($contrato->veiculo()->exists())
                                        <option value="{{$contrato->veiculo->id}}">{{$contrato->veiculo->placa}}</option>
                                    @endif

                                @endif
                            </select>
                            @error('veiculo')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label  class="form-label">Data Inicial<span class="sr-only"> </span></label>
                            <input name="data_inicio" class="form-control datepicker" value="{{isset($contrato)?\Carbon\Carbon::parse($contrato->data_inicial)->format('d/m/Y'):\Carbon\Carbon::now()->format('d/m/Y')}}">
                            @error('data_inicio')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label  class="form-label">Fim da Garantia<span class="sr-only"> </span></label>
                            <input name="data_garantia" class="form-control datepicker">
                            @error('data_garantia')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label  class="form-label">Técnico<span class="sr-only"> </span></label>
                            <select name="tecnico" class="form-control">
                                @foreach($tecnicos as $tecnico)
                                    @if(isset($contrato))
                                        @if($contrato->tecnico->id == $tecnico->id)
                                            <option selected value="{{$tecnico->id}}">{{$tecnico->nome_completo}}</option>
                                        @else
                                            <option value="{{$tecnico->id}}">{{$tecnico->nome_completo}}</option>
                                        @endif
                                    @else
                                        <option value="{{$tecnico->id}}">{{$tecnico->nome_completo}}</option>
                                    @endif

                                @endforeach
                            </select>
                            @error('tecnico')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label  class="form-label">Descrição<span class="sr-only"> </span></label>
                            <textarea rows="5"  class="form-control" name="descricao">{{isset($contrato)?$contrato->descricao_cliente:""}}</textarea>
                            @error('descricao')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">Observações<span class="sr-only"> </span></label>
                            <textarea rows="5"  class="form-control" name="observacao">{{isset($contrato)?$contrato->observacao:""}}</textarea>
                            @error('observacao')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label  class="form-label">Solução<span class="sr-only"> </span></label>
                            <textarea class="form-control" name="solucao" id="summernote-contrato">{{isset($contrato)?$contrato->solucao:""}}</textarea>
                            @error('solucao')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                    @if(isset($contrato))
                        <button class="btn btn-warning" onclick="return confirm('Deseja editar esse registro?')" type="submit">Editar</button>
                        @can('contrato-deletar')
                            <a href="{{route('contrato.excluir',['contrato'=>$contrato])}}" onclick="return confirm('Deseja excluir esse registro?')" class="btn btn-danger" style="float: right" type="submit">Deletar</a>
                        @endcan



                    @else
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif

                    <a href="{{route('contrato.index')}}" class="btn btn-dark" type="submit">Voltar </a>

                </div>
                <!--end::Footer-->
            </form>
            <!--end::Body-->


</div>
@if(isset($contrato))
<!-- Modal -->
<div class="modal fade" id="proximo-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('contrato.mudar.status',['contrato'=>$contrato])}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mudar Status</h5>


                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label  class="form-label">Observação<span class="sr-only"> </span></label>
                            <textarea name="descricao" class="form-control"></textarea>
                            @error('cliente')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <input name="status_id" id="id-modal-status">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
