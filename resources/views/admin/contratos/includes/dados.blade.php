
<div class="row">
            <form class="needs-validation" novalidate="" method="post" action="{{isset($contrato)?route('contrato.atualizar',['contrato'=>$contrato]):route('contrato.cadastrar')}}">
                {{csrf_field()}}
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label  class="form-label">Cliente<span class="sr-only"> </span><span id="editar-cliente"></span></label>
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
                            <label  class="form-label">Veiculo<span class="sr-only"> </span><span id="editar-veiculo"></span></label>
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
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
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
                            <textarea rows="5"  class="form-control" name="descricao"></textarea>
                            @error('descricao')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label  class="form-label">Observações<span class="sr-only"> </span></label>
                            <textarea rows="5"  class="form-control" name="observacao"></textarea>
                            @error('observacao')
                            <div class="invalid-feedback">{{@$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label  class="form-label">Solução<span class="sr-only"> </span></label>
                            <textarea class="form-control" name="solucao" id="summernote-contrato"></textarea>
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
                        <button class="btn btn-warning" type="submit">Editar</button>
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
