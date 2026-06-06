<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use App\Mail\ContactConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return;
    }

    public function store(ContactRequest $request)
    {
        try {
            // Salvar no banco de dados
            $contact = Contact::create($request->validated());


            // Enviar email de confirmação para o usuário
            Mail::to($contact->email)->send(new ContactConfirmationMail($contact));

            return redirect()->back()->with(
                'success',
                "Obrigado, {$contact->name}! Sua mensagem foi enviada com sucesso. Nossa equipe entrará em contato em até 24 horas."
            );
        } catch (\Exception $e) {
            Log::error('Erro ao enviar formulário de contato: ' . $e->getMessage());

            return redirect()->back()->with(
                'error',
                'Ocorreu um erro ao enviar sua mensagem. Tente novamente ou entre em contato por telefone.'
            )->withInput();
        }
    }
}
