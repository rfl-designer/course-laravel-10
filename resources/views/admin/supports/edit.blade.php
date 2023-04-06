<h1>Dúvida {{ $support->id }}</h1>

<x-alert/>

<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }}</li>
    <li>Descrição: {{ $support->body }}</li>
</ul>

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @method('put')
    @include('admin.supports.partials.form', [
        'support' => $support
    ])
</form>