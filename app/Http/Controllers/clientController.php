<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientRequest;
use Illuminate\Http\Request;
use App\Models\Client;

class clientController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = Client::all();
        $this->middleware(function ($request, $next) {
			$this->setBaseRequest($request);
			return $next($request);
		});
        
    }
    public function consult(){
        return $this->client;
    }

    public function create(clientRequest $request){
        $client = Client::create($request->validated());
        return response()->json($client, 200);
    }
    public function setBaseRequest(Request $request){
        $request->headers->set('Accept', 'application/json');
		$request->merge((array)json_decode($request->getContent(), true));
    }
}
