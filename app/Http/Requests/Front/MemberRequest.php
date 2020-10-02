<?php
namespace App\Http\Requests\Front;

use App\Http\Requests\Request;

class MemberRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email'=>'required|email|unique:users,email', // validate for insert
			'password'=>'required|confirmed',
			'name'=>'required',
			'lastname'=>'required',
			'acceptance'=>'required'
		];
	}

}
