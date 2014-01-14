<?php

Validator::resolver(function($translator, $data, $rules, $messages)
{
	$messages = Lang::get( 'lanager-core::validation' ); // override messages
	return new Zeropingheroes\LanagerCore\Validators\CustomValidator($translator, $data, $rules, $messages);
});
