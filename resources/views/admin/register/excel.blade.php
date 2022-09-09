<?php
$fheads=App\Models\CmsFormField::Select()
        ->Where('form_id', $form_id)
        ->get();
?>
<table>
<tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Tel&eacute;fono</th>
    <th>Comentario</th>
@foreach ($fheads as $fh)
    <th>{!! $fh->name !!}</th>
@endforeach
    <th>Fecha de Registro</th>
</tr>
@foreach ($registers as $register)
<tr>
    <td>{{ $register->name }}</td>
    <td>{{ $register->email }}</td>
    <td>{{ $register->phone }}</td>
    <td>{{ $register->comments }}</td>
@foreach ($fheads as $fh)
<?php
$rf=App\Models\CmsRegisterField::Select()
        ->Where('register_id', $register->id)
        ->Where('field_id', $fh->id)
        ->first();
?>
    @if($rf!=null)
        <td>{!! $rf->get_value() !!}</td>
    @endif
@endforeach
    <td>{{ $register->created_at }}</td>
</tr>
@endforeach
</table>
