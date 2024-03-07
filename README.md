# APIREST
A APIREST disponibiliza maneiras de se operar em informação armazenada com persistência de dados.

#### Recursos disponíveis para acesso via API:

- Busca paginada de produtos
- Criação de produtos
- Busca por produto único
- Atualização de propriedade
- Remoção de produto do banco de dados

#### Acesso
Digite git clone e cole a URL já copiada no link. Pressione ENTER para criar seu clone local.

#### Métodos 
Requisições para a API devem seguir os padrões:

| método   | Descrição       |  |
| :---------- | :--------- | :------------------------------------------ |
| `GET`      |  Retorna informações de um ou mais registros. |
| `POST`      |  Utilizado para criar um novo registro. |
| `PUT`      |  Atualiza dados de um registro. |
| `DELETE`      |  Remove um registro do sistema. |

## Descrição de endpoint
#### Retorna todos os produtos

```http
  GET: /api/products
```
```
INDEX
- Define o limite de consulta de produtos por pagina (10)
- Retorna os produtos de forma paginada
```
```
FORMATO DE DADOS
  Response 200 OK
  {
	"current_page": 1,
	"data": [],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/products?page=1",
	"from": null,
	"last_page": 1,
	"last_page_url": "http:\/\/127.0.0.1:8000\/api\/products?page=1",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/127.0.0.1:8000\/api\/products?page=1",
			"label": "1",
			"active": true
		},
		{
			"url": null,
			"label": "Next &raquo;",
			"active": false
		}
	],
	"next_page_url": null,
	"path": "http:\/\/127.0.0.1:8000\/api\/products",
	"per_page": 10,
	"prev_page_url": null,
	"to": null,
	"total": 0
}
```
#### Cria um produto 

```http-
  POST /api/product
```
```
STORE
- Valida os campos obrigatórios do produto(nome,descrição, preço)
- Verifica se o produto já foi criado
- Cria o produto e armazena no banco de dados
```
```
FORMATO DE DADOS
 Response 201 CREATED
  {
	"menssage": "Sucessfully created",
	"data": {
		"nome": "garrafa 2",
		"descricao": "cheguei",
		"preco": "100",
		"updated_at": "2024-03-07T19:44:23.000000Z",
		"created_at": "2024-03-07T19:44:23.000000Z",
		"id": 11
	}
}

Response 422 Unprocessable Content
{
	"message": "The nome field is required.",
	"errors": {
		"nome": [
			"The nome field is required."
		]
	}
}
```

#### Busca um produto específico

```http
  GET /api/product/{id}
```
```
SHOW
- Busca um produto atravês do ID
- Valida se o produto existe
- Retorna o produto
```
```
FORMATO DE DADOS
Response 404 Not Found
{
	"data": "Product not found"
}

Response 200 OK
{
	"id": 1,
	"nome": "Garrafa",
	"descricao": "metal bom",
	"preco": 30,
	"created_at": "2024-03-07T19:56:24.000000Z",
	"updated_at": "2024-03-07T19:56:24.000000Z"
}
```  

#### Atualiza um produto

```http
  PUT /api/product/{id}
```
```
UPDATE
- Valida se o produto existe
- Verifica se o produto foi atualizado com sucesso
- Retorna uma resposta de sucesso e atualiza o banco de dados
```
```
FORMATO DE DADOS
  Response 200 OK
  {
	"data": "Updated sucessfully",
	"product": {
		"id": 1,
		"nome": "teste",
		"descricao": "teste",
		"preco": 100,
		"created_at": "2024-03-07T19:56:24.000000Z",
		"updated_at": "2024-03-07T19:58:41.000000Z"
	}
}

Response 422 Unprocessable Content
{
	"data": "product does not exist"
}
```
#### Deleta um produto

```http
  DELETE /api/product/{id}
```
```
UPDATE
- Valida se o produto existe
- Se o produto não existir exibe um erro 404
- Deleta o produto
```
```
FORMATO DE DADOS
Response 200 OK
{
	"data": "Deleted sucessfully"
}

RESPONSE 404 Not Found
{
	"data": "Product not exist"
}
```
  
