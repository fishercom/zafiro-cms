<?php

$status_list = Config::get('constants.order_status');

?>
<table>
    <tr>
        <th class="col-sm-2">Fecha</th>
        <th class="col-sm-2">Empresa / Local</th>
        <th class="col-sm-2">Cliente</th>
        <th class="col-sm-3">Producto</th>
        <th class="col-sm-1 text-right">Monto</th>
        <th class="col-sm-1 text-center">Estado</th>
    </tr>
    @foreach ($data as $order)
    <?php
        $user = $order->member->user;
        $quotation = $order->quotation;
        $company = $quotation->company;
        $local = $quotation->local;
        $member_name = $user->name.' '.$user->lastname;
        $item_name = $order->detail? $order->detail[0]->item_name: null;
        $params = '?page='.$page;
    ?>
    <tr>
        <td>{{ $order->created_at }}</td>
        <td>{{ $company->name }} / {{ $local->name }}</td>
        <td>{{ $member_name }}</td>
        <td>{{ $item_name }}</td>
        <td class="text-right">S/ {{ $order->total }}</td>
        <td class="text-center"><span class="label label-{{ order_status_color($order->status) }}">{{ $status_list[$order->status] }}</span></td>
    </tr>
    @endforeach
</table>
