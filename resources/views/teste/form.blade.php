@extends('dashboard.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('home')}}">Início</a></li>
    <li class="breadcrumb-item active"> <a href="{{route('user.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active"> Alterar usuário</li>
@endsection

@section('content')

    @include('layouts.form.form-errors-message')
    <form method="POST" action="{{route('test_save')}}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header bg-transparent"> <b>Alterar usuário</b> </div>
            <div class="card-body">

            {{csrf_field()}}

<hr>


            {!!
                $form->checkboxList('testecheck')
                                    ->model($user, 'status')
                                    ->checkedValues([5,2])
                                    ->options([
                                        ['key'=>'1','value' => 'Thiago'],
                                        ['key'=>2,'value' => 'Júnior'],
                                        ['key'=>3,'value' => 'Pedro'],
                                        ['key'=>4,'value' => 'Andersonn'],
                                        ['key'=>5,'value' => 'Guilherme'],
                                    ], 'key', 'value')
                                    ->make();
            !!}



            {!! $form->text('name')->model($user, 'name')->wrapCol('Nome')->attr(['class'=>'form-control'])->make(); !!}
            {!! $form->text('name')->model($user, 'name')->wrapCol('sss')->attr(['class'=>'form-control'])->make(); !!}

            {!!
                $form->select('testwe')->model($user, 'id')
                                     ->wrapSimple('Opções')
                                     ->attr(['class'=>'form-control'])
                                     ->placeholder('Selecione o item')
                                     ->options([
                                        ['key'=>'1','value' => 'Thiago'],
                                        ['key'=>2,'value' => 'Sobrinho']
                                     ], 'key', 'value')
                                     ->make();
            !!}

<hr>
            {!!
                $form->radio('testeradio')
                            ->model($user, 'status')
                            ->options([
                                ['key'=>'1','value' => 'Thiago'],
                                ['key'=>2,'value' => 'Sobrinho']
                            ], 'key', 'value')
                            ->make();
            !!}
<hr>
            {!!
                $form->checkbox('status')
                    ->wrapCol(' Ativo ')
                    ->value(1)
                    ->model($user, 'status')
                    ->make();
            !!}
<hr>



            </div>
            <div class="card-footer text-right">
                <a class="btn btn-link" href="{{route('user.index')}}">cancelar</a>
                <input type="submit" value="Alterar" class="btn btn-success">
            </div>
        </div>
     </form>
@endsection
