<?php
namespace Zeropingheroes\LanagerCore\Models;


class InfoPage extends BaseModel {

	public static $rules = array(
		'title'		=> 'required|max:255',
		'parent_id'	=> 'numeric|exists:info_pages,id'
	);

}