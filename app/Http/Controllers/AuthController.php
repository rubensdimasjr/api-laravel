<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

/**
 * @group Autenticação
 * 
 * A autenticação de uma API é um processo que verifica e confirma a identidade de um usuário ou aplicação antes de permitir o acesso aos recursos da API. Ela envolve o uso de credenciais, como tokens de acesso ou chaves de API, para garantir a segurança e proteção dos dados. A autenticação ajuda a controlar o acesso e garantir que apenas usuários autorizados possam interagir com a API.
 */
class AuthController extends Controller
{

    use HttpResponses;

    /**
     * Requisição de Acesso
     * 
     * Realiza uma autenticação através do e-mail e senha do usuário.
     * 
     * @bodyParam email string required E-mail do usuário.
     * @bodyParam password string required Senha do usuário.
     * 
     * @response scenario=success {
     *     "message": "Authorized",
     *     "status": 200,
     *     "data": {
     *          "token": {YOUR_AUTH_KEY}
     *      }
     * }
     * 
     * @response status=403 scenario="not authorized" {
     *       "message": "Not Authorized",
     *       "status": 403,
     *       "data": []
     * }
     * 
     * @return JsonResponse
     */
    public function login(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->response("Authorized", 200, [
                'token' => $request->user()->createToken('invoice')->plainTextToken
            ]);
        }

        return $this->response("Not Authorized", 403);
    }

    /**
     * Requisição de Saida
     * 
     * Realiza o logout de um usuário autenticado.
     * 
     * @header Authorization Bearer {YOUR_AUTH_KEY}
     * 
     * @response status=401 scenario="unauthenticated" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @response scenario=success {
     *      "message": "Token Revoked",
     *      "status": 200,
     *      "data": []
     * }
     * 
     * @authenticated
     * 
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response("Token Revoked", 200);
    }
}