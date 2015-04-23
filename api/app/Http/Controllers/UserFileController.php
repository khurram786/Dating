<?php namespace App\Http\Controllers;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserFileController extends Controller {

	/**
	 * The user instance.
	 */
	protected $_user;

	/**
	 * The current request instance.
	 */
	protected $_request;

	/**
	 * Populate the class attributes.
	 *
	 * @param Request
	 */
	public function __construct(Request $request)
	{
		
		// We assign the value of the current request.
		$this->_request = $request;

		// if the user is authenticated we return the instance otherwise we return null.
		$this->_user = (Auth::check()) ? Auth::user() : null;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if($this->_request->file('file')->isValid())
		{
			$filePath = '/news/app/imgDrop/Users/user_'.$this->_user->id.".".$request->file('file')->guessExtension();
			if($request->file('file')->move('../../app/imgDrop/Users/', $filePath))
			{
				DB::update('update users set img = ? where id = ?', [$filePath, $this->_user->id]);
				return response($filePath);	
			}
		}
		return response("upload failure.", 441);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$filePath = DB::select('select img from users where id = ?', [$this->_user->id])[0]->img;
		return response($filePath);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
