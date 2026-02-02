<div>

    @if(session()->has('alerta'))
        <div class="alert alert-{{Session::get('alerta')['tipo'] }} alert-dismissible fade show" role="alert">
            {{Session::get('alerta')['texto'] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
