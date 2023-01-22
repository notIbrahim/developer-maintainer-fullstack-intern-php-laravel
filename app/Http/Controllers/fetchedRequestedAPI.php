<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface wasteTypes
{
    public function index($requested);
    public function materials($requested);
    public function waste($requested);
}

class fetchedRequestedAPI extends Controller implements wasteTypes
{
    // This is Check Sanity Data because compact or me having weird interpretation
    public function parseAPI($URL = [])
    {
        $init = curl_init();
        curl_setopt_array($init, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);
        $data = curl_exec($init);
        $data = json_decode($data, true);
        return $data;
    }

    public function materials($requested)
    {
        if($requested == 'PostmanRuntime' || $requested == 'curl')
        {
            redirect('/api');
        }

        if($requested[0] == 'POST')
        {
            $materials = $this->index($requested);
            $materials = json_decode($materials, true);
            unset($requested[0]);
            $data = array(
                'id' => 'TYP-001-RCY',
                'materials' => 'MAT-001-TRC',
                'Kategori' => $requested[2],
                'name' => $requested[1]
            );
            unset($requested[1]);
            unset($requested[2]);
            $data = array_merge($materials, array($data));
            $freshData = array("types" => $data);
            return json_encode($freshData);
        }
        $materials = $this->index($requested);
        $materials = json_decode($materials, true);
        $i = 0;
        foreach($materials as $key)
        {
            unset($materials[$i]['id']);
            $i++;
        }
        $data = array("materials" => $materials);
        return $data;
    } 

    // Out Logic here due to Weirdness
    // There Another API for call of materials API here

    public function materialAPI($requested)
    {
        
        if($requested == "GET")
        {
            $materialCall = $this->materials($requested);
            return json_encode($materialCall);
        }
    }

    public function index($requested)
    {
        $data= array(
            array(
                "id" => "TYP-001-KET",
                "material_id" => "MAT-001-KET",
                "Kategori" => "Kertas",
                "name" => "Kertas HVS",
            ),
            
            array(
                "id" => "TYP-002-PET",
                "material_id" => "MAT-002-PET",
                "Kategori" => "Plastik",
                "name" => "Plastik PET"
            ),
            array(
                "id" => "TYP-002-KSK",
                "material_id" => "MAT-002-PLS",
                "Kategori" => "Recycle",
                "name" => "Plastik Kresek"
            ),
            array(
                "id" => "TYP-004-BJR",
                "material_id" => "MAT-004-BJR",
                "Kategori" => "Baja",
                "name" =>"Baja Ringan"
            ),
        );
        
        if($requested == 'PostmanRuntime' || $requested == 'curl')
        {
            $types = array(
                "types" => $data
            );
            return json_encode($types);
        }
        else
        {
            return json_encode($data);
        }     
    }

    public function waste($requested)
    {
        if($requested == 'PostmanRuntime' || $requested == 'curl')
        {
            redirect('/api');
        }
        else
        {
            $fetchData = $this->index($requested);
            $fetchData = json_decode($fetchData, true);
            $types = array("types" => $fetchData);
            return json_encode($types);
        }
    }
}
     
// will continue
