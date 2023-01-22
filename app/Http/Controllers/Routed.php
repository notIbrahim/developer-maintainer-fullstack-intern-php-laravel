<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class Routed extends Controller
{
    public function apps(Request $requested)
    {
        $sanitizeUser = preg_replace("/[^a-zA-Z ]/", "", $requested->headers->get('User-Agent'));
        if($sanitizeUser !== 'PostmanRuntime' && $sanitizeUser !== 'curl')
        {
            $api = new fetchedRequestedAPI;
            $data = $api->waste($sanitizeUser);
            $data = json_decode($data, true);
            return view('app', compact('data'));
        }
        return abort(401);
    }

    public function materialAPI(Request $requested)
    {
        $sanitizeUser = preg_replace("/[^a-zA-Z ]/", "", $requested->headers->get('User-Agent'));
        if($sanitizeUser == 'PostmanRuntime' || $sanitizeUser == 'curl')
        {
            $api = new fetchedRequestedAPI;
            $apiReceive = $api->materials($sanitizeUser = 'A');
            return json_encode($apiReceive);
        }
        return abort(401);
    }
    public function index(Request $requested)
    {
        $sanitizeUser = preg_replace("/[^a-zA-Z ]/", "", $requested->headers->get('User-Agent'));
        if($sanitizeUser == 'PostmanRuntime' || $sanitizeUser == 'curl')
        {
            header('Content-Type: application/json', true, 200);
            $viewAPI = new fetchedRequestedAPI();
            $requestedAPI = $viewAPI->index($sanitizeUser);
            return $requestedAPI;
        }
        return abort(401);
    }

    public function addView(Request $requested)
    {
        $sanitizeUser = preg_replace("/[^a-zA-Z ]/", "", $requested->headers->get('User-Agent'));
        if($sanitizeUser !== 'PostmanRuntime' && $sanitizeUser !== 'curl')
        {
            $api = new fetchedRequestedAPI;
            $data = $api->materials($sanitizeUser);
            // $data = $api->parseAPI("https://gist.githubusercontent.com/yudiandela/c386514899ebc0285c454cfe749d1f1e/raw/6da00440d2f39adbad0105ce0d7bbdacd2be248f/materials");
            return view('adder', compact('data'));
        }
        return abort(401);
    }

    public function added(Request $request)
    {
        $newFetch = new fetchedRequestedAPI;
        $requested[] = $request->method();
        $requested[] = $request->names;
        $requested[] = $request->kategori;
        // Assign newData to new Class fetchedRequestedAPI specific to Materials which pass param reques
        $newData = $newFetch->materials($requested);
        $data = json_decode($newData, true);
        return view('app', compact('data'));
    }

    public function deleted(Request $request)
    {
        // Function Borked can't use Delete so i don't think it will work because deadline
        dd($request);
    }
}
