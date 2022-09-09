<div class="seccion_formulario">
	<div class="container">

		<h1>{{ $page->title }}</h1>
		
            {!! Form::open(['url' => url('/api/form/'), 'method'=>'POST', 'id'=>'frm_contact']) !!}
                <input type="hidden" name="form_id" value="1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('Nombres y Apellidos') }}
                            </div>
                            <input type="text" name="name" class="required">
                            <div class="label-err d-none">{{ transl('Dato requerido') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('E-mail') }}
                            </div>
                            <input type="email" name="email" class="required">
                            <div class="label-err d-none">{{ transl('Dato requerido') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('Teléfono') }}
                            </div>
                            <input type="text" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('Empresa') }}
                            </div>
                            <input type="text" name="fields[company]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('Motivo de contacto') }}
                            </div>
                            <input type="text" name="fields[subject]" class="required">
                            <div class="label-err d-none">{{ transl('Dato requerido') }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="campo">
                            <div class="txt">
                                {{ transl('Mensaje') }}
                            </div>
                            <textarea name="message" class="required"></textarea>
                            <div class="label-err d-none">{{ transl('Dato requerido') }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="campo_check">
                            <input type="checkbox" name="acceptance" value="1" class="required">
                            <div class="txt">
                                {{ transl('Acepto las Políticas de Privacidad de Minera Las Bambas') }}
                            </div>
                        </div>
                        <div class="label-err chk-err d-none">{{ transl('Dato requerido') }}</div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn_rojo" sending="{{ transl('Enviando...') }}">
                            {{ transl('Enviar') }}
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="form-message text-center d-none">
                <h5>{{ transl('Los datos se han enviado con éxito.') }}</h5>
            </div>

	</div>
</div>

