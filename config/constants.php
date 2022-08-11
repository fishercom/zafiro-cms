<?php

return [
    'default_timezone'=>'America/Lima',
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

    'mime_image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'mime_document'=>'mimes:pdf,doc,docx,png,jpg|max:2048',
];
