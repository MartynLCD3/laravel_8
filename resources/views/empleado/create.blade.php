@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ url('/empleado') }}" enctype="multipart/form-data">
    @csrf
    @include("empleado.form",['modo'=>'Nuevo'])
    </form>
</div>
@endsection