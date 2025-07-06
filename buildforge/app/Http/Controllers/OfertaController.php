<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfertaMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Newsletter;


class OfertaController extends Controller
{
    // Exibe o formulário de envio
    public function form()
    {
        return view('admin.ofertas.form'); // <- certifique-se que essa view existe
    }

    // Envia a oferta para todos os clientes
        public function enviarOferta(Request $request)
        {
            $request->validate([
                'mensagem' => 'required|string',
            ]);

            $mensagem = $request->mensagem;

            // Busca e-mails da tabela newsletters
             $emails = Newsletter::pluck('email')->toArray();;

            foreach ($emails as $email) {
                Mail::to($email)->send(new OfertaMail($mensagem));
            }

            return redirect()->route('admin.ofertas.form')->with('success', 'Ofertas enviadas com sucesso!');
        }


}
