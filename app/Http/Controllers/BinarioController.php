<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BinarioController extends Controller
{
    public function registerBinario($id)
    {
        // Montando a URL para o arquivo
        $url = url('compensation/index.php');

        // Enviando a requisição
        $response = Http::asForm()->post($url, [
            'type' => 'CadastroBinario',
            'user_id' => $id,
        ]);

        if ($response->successful()) {
            return response()->json($response->body());
        }
        return false;
    }

    public function payBinario($id)
    {
        // Montando a URL para o arquivo
        $url = url('compensation/index.php');

        // Enviando a requisição
        $response = Http::asForm()->post($url, [
            'type' => 'Bonificacao',
            'idpedido' => $id,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            return $response->body();
        }
        return false;
    }

    public function compensacaoBinaria()
    {
        // Montando a URL para o arquivo
        $url = url('compensation/index.php');

        // Enviando a requisição
        $response = Http::asForm()->post($url, [
            'type' => 'CompensacaoBinaria',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($response->body());
        }
        return false;
    }

    public function ranking()
    {
        // Montando a URL para o arquivo
        $url = url('compensation/index.php');

        // Enviando a requisição
        $response = Http::asForm()->post($url, [
            'type' => 'Rank',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        }
        return false;
    }
}
