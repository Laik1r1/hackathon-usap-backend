<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatPDFController extends Controller
{
  /*
    public function uploadPDF(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240', 
        ]);

        $file = $request->file('file');

        $response = Http::withHeaders([
            'x-api-key' => env('CHATPDF_API_KEY'),
        ])->attach(
            'file',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post('https://api.chatpdf.com/v1/sources/add-file');

    return response()->json($response->json(), $response->status());

        if ($response->successful()) {
            return response()->json([
                'sourceId' => $response->json('sourceId')
            ]);
        } else {
            return response()->json([
                'error' => $response->json()
            ], $response->status());
        }
    }
*/
public function MakeQuestion(Request $request)
    {
       
        $request->validate([
            'msj' => 'required|string|filled',
        ]);

 $response = Http::withHeaders([
    'x-api-key' => 'sec_IECCLxX6vbzXY4jKOhRWHqNPMGFsyjHJ',
    'Content-Type' => 'application/json',
])->withBody(json_encode([
    'sourceId' => 'src_uAqDm2Utj4TYNPaEaxVzR',
    'messages' => [
        [
            'role' => 'user',
            'content' => $request->msj,
        ],
    ],
]), 'application/json')->post('https://api.chatpdf.com/v1/chats/message');
       return response()->json($response->json());
    }
}
