<!-- Modal -->
<div class="modal fade" id="formularioClienteModal" tabindex="-1" aria-labelledby="modalCliente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post"  name="cadastrarClienteModal" id="cadastrarClienteModal">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCliente">Cadastro de Novo Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="form-atualizavel-cliente">
                @include('admin.usuarios.includes.form',['modal'=>true,'grupo_selecionado'=>$grupo_selecionado])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>
