<?php

return [
    'default_timezone'=>'America/Lima',
    'user_type' => [
        'MEMBER'=>'Miembro',
        'COMPANY'=>'Empresa'
    ],
    'company_status' => [
        null => '',
    	'1'=>'Registrado',
    	'2'=>'Pendiente',
        '3'=>'Afiliado',
        '4'=>'Observado',
        '6'=>'Desistió',
        '7'=>'Cerrado por Comercial',
        '9'=>'Registo Web',
    ],
    'member_status' => [
        'PENDING'=>'En Proceso',
        'ACTIVE'=>'Activo',
        'BLOCKED'=>'Bloqueado',
        'TRASH'=>'Eliminado'
    ],
	'product_status' => [
		'PENDING'=>'En Proceso',
		'PUBLISHED'=>'Publicado',
		'TRASH'=>'Eliminado'
	],
    'quotation_status' => [
        'PENDING'=>'Pendiente',
        'ATTENDED'=>'Atendido',
        'REJECTED'=>'Rechazado',
        'CONFIRMED'=>'Confirmado',
        'DELIVERED'=>'Entregado',
        'RECIEVED'=>'Recibido',
        'DISCARDED'=>'Descartado'
    ],
    'order_status' => [
    	'PENDING'=>'En Proceso',
    	'PAID'=>'Pagado',
    	'REFUSED'=>'Rechazado'
    ],
    'document_type' => [
    	'DNI' => 'DNI',
    	'RUC' => 'RUC',
    	'CE' => 'CE',
    	'PASSPORT' =>'Pasaporte'
    ],
    'account_type' => [
        'AHORROS' => 'Cuenta de Ahorros',
        'CCORRIENTE' => 'Cuenta Corriente',
        'EMPRESARIAL' => 'Empresarial',
        'MANCOMUNADA' =>'Mancomunada'
    ],
    'unity_type' => [
        'kg' => 'kilogramos',
        'm' => 'metros',
        'cm' => 'centimetros',
        'mm' => 'milimetros',
        'inch' => 'pulgadas',
        'W' => 'watts',
    ],

    'mime_image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'mime_document'=>'mimes:pdf,doc,docx,png,jpg|max:2048',
];
