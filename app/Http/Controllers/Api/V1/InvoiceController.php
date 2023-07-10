<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Gerenciamento de Invoices
 * 
 * Endpoints para gerenciar a API.
 */
class InvoiceController extends Controller
{

    use HttpResponses;

    /**
     * Exibe lista de invoices
     * 
     * Realiza uma busca para listagem dos invoices com opções de filtro e paginação.
     * 
     * <aside class="notice">
     * <b>FILTROS</b>
     * <br />
     * <br />
     *      <b>Parâmetros</b>: (value, type, paid, payment_date)
     * <br />
     *      <b>Operadores</b>: <br />
     *   gt ➡️ > (maior que)<br />
     *   gte ➡️ >= (maior ou igual)<br />
     *   lt ➡️ < (menor que)<br />
     *   lte ➡️ <= (menor ou igual)<br />
     *   eq ➡️ = (igual)<br />
     *   ne ➡️ != (não igual)<br />
     *   in ➡️ in (existe em)<br />
     * <br />
     * Utilização: <b>api/v1/invoices</b>?<u>paid[eq]=1</u>&<u>value[gt]=5000</u>&<u>type[in]=[b,p]</u> ✅
     * </aside>
     * 
     * @queryParam page int Utilizado para escolha da página. Example: 1
     * 
     * @response scenario="success" {
     *      {
     *          "data":[
     *              "user": {
     *                  "name":"Test name",
     *                  "email":"test@email.com.br"
     *              },
     *              "type":"Pix", // [Pix, Boleto, Cartão]
     *              "value":"R$ 0.000,00",
     *              "paid":"Pago", // ou 'Não Pago'
     *              "payment_date":"d/m/Y H:i:s", // ou Null
     *              "payment_since":"2 dias atrás", // ou Null
     *          ]
     *      },
     *  	...
     * }
     * 
     * @response status=401 scenario="unauthenticated" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @authenticated
     */
    public function index(Request $request)
    {

        /* return InvoiceResource::collection(Invoice::where([

        ])->with('user')->get()); */

        /* return InvoiceResource::collection(Invoice::with('user')->get()); */

        return (new Invoice())->filter($request);

    }

    /**
     * Armazena um invoice recém criado
     * 
     * @bodyParam user_id integer required ID do usuário. Example: 2
     * @bodyParam type string required Tipo pagamento (Pix, Cartão, Boleto). Example: C
     * @bodyParam paid integer required Verificação do pagamento. Example: 1
     * @bodyParam value numeric required Valor do pagamento. Example: 2.500,00
     * @bodyParam payment_date datetime Data do pagamento. Example: 1999-11-20 10:15:20
     * 
     * @response scenario="success" {
     *      "message": "Invoice created",
     *      "status": 200,    
     *      "data":{
     *          "user": {
     *              "name":"Test name",
     *              "email":"test@email.com.br"
     *          },
     *          "type":"Pix", // [Pix, Boleto, Cartão]
     *          "value":"R$ 0.000,00",
     *          "paid":"Pago", // ou 'Não Pago'
     *          "payment_date":"20/11/1999 10:00:15", // ou Null
     *          "payment_since":"2 dias atrás", // ou Null
     *      }
     * }
     * 
     * @response status=422 scenario="validation failed" {
     *      "message": "Validation failed",
     *      "status": 422,
     *      "data": [
     *          // errors...
     *      ]
     * }
     * 
     * @response status=400 scenario="not deleted" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @authenticated
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|max:1|in:' . implode(',', ['B', 'C', 'P']),
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable',
            'value' => 'required|numeric|between:1,9999.99'
        ]);

        if ($validator->fails()) {
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $created = Invoice::create($validator->validated());

        if ($created) {
            return $this->response('Invoice created', 200, new InvoiceResource($created->load('user')));
        }

        return $this->error('Invoice not created', 400);
    }

    /**
     * Exibe um invoice específico
     * 
     * @response scenario="success" {
     *      "data": {
     *          "name":"Test name",
     *          "email":" test@email.com.br"
     *      },
     *      "type":"Pix", // [Pix, Boleto, Cartão]
     *      "value":"R$ 0.000,00",
     *      "paid":"Pago", // ou 'Não Pago'
     *      "payment_date":"20/11/1999 10:00:15", // ou Null
     *      "payment_since":"2 dias atrás", // ou Null
     * }
     * 
     * @response status=401 scenario="not authorized" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @urlParam invoice_id int required ID do invoice. Example: 1
     * 
     * @authenticated
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Atualiza um invoice específico
     * 
     * @bodyParam user_id integer required ID do usuário. Example: 2
     * @bodyParam type string required Tipo pagamento (Pix, Cartão, Boleto). Example: C
     * @bodyParam paid integer required Verificação do pagamento. Example: 1
     * @bodyParam value numeric required Valor do pagamento. Example: 2.500,00
     * @bodyParam payment_date datetime Data do pagamento. Example: 1999-11-20 10:15:20
     * 
     * @response scenario="success" {
     *      "message": "Invoice updated",
     *      "status": 200,    
     *      "data":{
     *          "user": {
     *              "name":"Test name",
     *              "email":"test@email.com.br"
     *          },
     *          "type":"Pix", // [Pix, Boleto, Cartão]
     *          "value":"R$ 0.000,00",
     *          "paid":"Pago", // ou 'Não Pago'
     *          "payment_date":"20/11/1999 10:00:15", // ou Null
     *          "payment_since":"2 dias atrás", // ou Null
     *      }
     * }
     * 
     * @response status=422 scenario="validation failed" {
     *      "message": "Validation failed",
     *      "status": 422,
     *      "data": [
     *          // errors...
     *      ]
     * }
     * 
     * @response status=400 scenario="not deleted" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @urlParam invoice_id required ID do invoice. Example: 1
     * 
     * @authenticated
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|max:1|in:' . implode(',', ['B', 'C', 'P']),
            'paid' => 'required|numeric|between:0,1',
            'value' => 'required|numeric',
            'payment_date' => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $invoice->update([
            'user_id' => $validated['user_id'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'value' => $validated['value'],
            'payment_date' => $validated['paid'] ? $validated['payment_date'] : null
        ]);

        if ($updated) {
            return $this->response('Invoice updated', 200, new InvoiceResource($invoice->load('user')));
        }

        return $this->error('Invoice not updated', 400);

    }

    /**
     * Remove um invoice específico.
     * 
     * @urlParam invoice_id required ID do invoice. Example: 1
     * 
     * @response scenario="success" {
     *      "message": "Invoice deleted",
     *      "status": 200,
     *      "data": []
     * }
     * 
     * @response status=400 scenario="not deleted" {
     *      "message": "Unauthenticated."
     * }
     * 
     * @authenticated
     */
    public function destroy(Invoice $invoice)
    {
        $deleted = $invoice->delete();

        if ($deleted) {
            return $this->response('Invoice deleted', 200);
        }

        return $this->error('Invoice not deleted', 400);
    }
}