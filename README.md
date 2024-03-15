# APIREST
A APIREST disponibiliza maneiras de se operar em informação armazenada com persistência de dados.

### Requisitos:
- Laravel Framework ^10.46.0
- DBeaver ^23.3.5
- PHP ^8.1
- MySQL ^8.0
- Composer ^2.7.1

## Preparando o ambiente:
#### Laravel
- Laravel Framework ^10.46.0 (Link do manual para instalação)
```
https://laravel.com/docs/10.x/installation
```
#### Dbeaver
- DBeaver ^23.3.5 (Link do manual para instalação)
```
https://dbeaver.io/download/
```
#### PHP
- PHP  ^8.1(Link do manual para instalação)
```
https://www.php.net/manual/pt_BR/install.php
```
#### MySQL
- MySQL ^8.0 (Link do manual para instalação)
```
https://www.digitalocean.com/community/tutorial-collections/how-to-install-mysql
```
 #### Composer 
- Composer ^2.7.1 ((Link do manual para instalação))
```
https://getcomposer.org/download/
```

## Abrindo o projeto
#### Como clonar o repositório?
1. Verifique se todos os requisitos estão devidamente instalados para prosseguir 
2. No terminal, Dentro da pasta raiz que deseja abrir o Projeto APIREST Digite git clone ,  e cole a URL já copiada no link. Pressione ENTER para criar seu clone local, exemplo:
```
git clone <URL_do_seu_repositorio>
```

#### Como instalar as dependências?
1. Execute o comando composer install para instalar todas as dependências de pacotes
```
Composer install
```
## Variáveis de ambiente
1. Crie um arquivo na pasta raiz do projeto com o nome .env
2. Copie todo o conteúdo do arquivo .env.example e cole no arquivo .env que foi criado.

## Conexão com o banco de dados
- Com as variáveis de ambiente configuradas, o MySQL e Dbeaver instalados, já podemos fazer nossa conexão com o banco de dados MySQL, usando o gerenciador Dbeaver-ce
1. Abra o Dbeaver
2. Clique em nova conexão, ou pressione Shift+Ctrl+N para iniciar uma nova conexão
3. Selecione o banco de dados MySQL 
4. Preencha campo senha no arquivo .env e nas configurações de conexão com sua senha
5. Clique em testar conexão
4. Clique em concluir para finalizar a conexão

## Fazendo as migrações
Faça as migrações do projeto para o banco de dados. Execute o seguinte comando:
```
php artisan migrate
```
## Iniciando um servidor
inicie um servidor local para executar a aplicação Laravel. Execute o seguinte comando:
```
php artisan serve
```

## Recursos disponíveis para acesso via API:
### Produtos
- Busca paginada de produtos
- Criação de produtos relacionados com uma categoria
- Busca por produto único
- Atualização de propriedade
- Exclusão de produto 
### Categorias
- Criação de Categoria
- Busca de todos os produtos de uma única categoria
- Busca única de categoria
- Atualização do nome da categoria
- Exclusão de categoria 



## Métodos 
- Requisições para a API devem seguir os padrões:

| método   | Descrição       |  |
| :---------- | :--------- | :------------------------------------------ |
| `GET`      |  Retorna informações de um ou mais registros. |
| `POST`      |  Utilizado para criar um novo registro. |
| `PUT`      |  Atualiza dados de um registro. |
| `DELETE`      |  Remove um registro do sistema. |

# Descrição de endpoint
### Retorna todos os produtos

```http
  GET: /api/products
```
```
INDEX
- Define o limite de consulta de produtos por pagina (10)
- Retorna os produtos de forma paginada
```
```json
FORMATO DE DADOS
  Response 200 OK
 {
	"data": {
		"current_page": 1,
		"data": [
			{
				"id": 1,
				"category_id": 1,
				"name": "Detox lift 3x und emagrecedor corpo perfeito",
				"description": "Fique linda como sempre sonhou",
				"price": 297
			},
			{
				"id": 2,
				"category_id": 1,
				"name": "Upmente kit 3 unidades super cerebro",
				"description": "Aumenta a concentração e a memória",
				"price": 297
			}
		],
		"first_page_url": "http:\/\/127.0.0.1:8000\/api\/products?page=1",
		"from": 1,
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
		"to": 2,
		"total": 2
	}
}
```
### Cria um produto 

```http-
  POST /api/product
```
```
STORE
- Valida os campos obrigatórios do produto(nome,descrição, preço,category_id)
- Verifica se o produto já foi criado
- Cria o produto e armazena no banco de dados
```
```json
FORMATO DE DADOS

Payload
{
	"name": "Upmente kit 3 unidades super cerebro",
	"description": "Aumenta a concentração e a memória",
	"price": 297,
	"category_id": 1
	
}

Response 201 CREATED
{
	"message": "Sucessfully created",
	"data": {
		"name": "Upmente kit 3 unidades super cerebro ",
		"description": "Aumenta a concentração e a memória",
		"price": 297,
		"category_id": 1,
		"id": 1
	}
}

Response 422 Unprocessable Content
{
	"message": "A name is required",
	"errors": {
		"name": [
			"A name is required"
		]
	}
}
```

### Busca um produto específico

```http
  GET /api/product/{id}
```
```
SHOW
- Busca um produto atravês do ID
- Valida se o produto existe
- Retorna o produto
```
``` json
FORMATO DE DADOS
Response 404 Not Found
{
	"message": "Product not found"
}

Response 200 OK 
{
	"data": {
		"id": 1,
		"category_id": 1,
		"name": "Upmente  kit 3 unidades super cerebro",
		"description": "Aumenta a concentração e a memória",
		"price": 197
	},
	"0": 200
}
```  

## Atualiza um produto

```http
  PUT /api/product/{id}
```
```
UPDATE
- Valida se o produto existe
- Verifica se o produto foi atualizado com sucesso
- Retorna uma resposta de sucesso e atualiza o banco de dados
```
```json
FORMATO DE DADOS

Payload
{
	"name": "Detox lift 3 unidades emagrecedor corpo perfeito",
	"description": "Fique linda como sempre sonhou",
	"price": 297
}


  Response 200 OK
{
	"message": "Updated sucessfully",
	"data": {
		"id": 1,
		"category_id": 1,
		"name": "Detox lift 2 unidades emagrecedor corpo perfeito",
		"description": "Fique linda como sempre sonhou",
		"price": 197
	}
}

Response 422 Unprocessable Content
{
	"message": "product does not exist"
}
```
## Deleta um produto

```http
  DELETE /api/product/{id}
```
```
UPDATE
- Valida se o produto existe
- Se o produto não existir exibe um erro 404
- Deleta o produto
```
```json
FORMATO DE DADOS
Response 200 OK
{
	"message": "Deleted sucessfully"
}

RESPONSE 404 Not Found
{
	"message": "Product not exist"
}
```

### Exemplo de novo (Create) [POST]
```json
Payload

{
	"name": "Detox lift 3 unidades emagrecedor corpo perfeito",
	"description": "Fique linda como sempre sonhou",
	"price": 297 ,
	"category_id": 1
	
}

Response 201 Created
{
	"message": "Sucessfully created",
	"data": {
		"name": "Detox lift 3 unidades  emagrecedor corpo perfeito",
		"description": "Fique linda como sempre sonhou",
		"price": 297 ,
		"category_id": 1,
		"id": 3
	}
}
```
## Categoria
### Retorna todas as categorias

```http
  GET: /api/categories
```
```
INDEX
-  Busca todas as categorias existentes
-  Retorna uma resposta
```
```json
FORMATO DE DADOS
  Response 200 OK
 {
	"data": [
		{
			"id": 1,
			"name": "Emagrecimento"
		},
		{
			"id": 2,
			"name": "Beleza"
		},
		{
			"id": 3,
			"name": "Biohacking"
		}
	],
	"0": 200
}
```
### Cria uma categoria 

```http-
  POST /api/categories
```
```
STORE
- Valida e cria categoria
- Retorna um resposta
```
```json
FORMATO DE DADOS

Payload

{
	"name": "Emagrecimento"
}

Response 201 CREATED
{
	"message": "Sucessfully created",
	"data": {
		"name": "Emagrecimento",
		"id": 3
	}
}

Response 422 Unprocessable Content
{
	"message": "A name is required",
	"errors": {
		"name": [
			"A name is required"
		]
	}
}
```

### Busca todos os produtos de uma categoria

```http
  GET /api/categories/{id}
```
```
SHOW
- Valida se a categoria existe
- Retorna uma resposta
```
``` json
FORMATO DE DADOS

Response 404 Not Found
{
	"message": "Category not found"
}

Response 200 OK 
{
	"data": {
		"id": 1,
		"name": "Emagrecimento",
		"products": [
			{
				"id": 1,
				"category_id": 1,
				"name": "Detox lift 3 unidades emagrecedor corpo perfeito",
				"description": "Noites tranquilas",
				"price": 297
			},
			{
				"id": 3,
				"category_id": 1,
				"name": "Detox lift emagrecedor corpo perfeito",
				"description": "Ingredientes naturais comprovados ",
				"price": 97
			},
			{
				"id": 4,
				"category_id": 1,
				"name": "Lipo lift sonho corpo perfeito",
				"description": "Uma revolução na busca por um corpo esbelto e saudável",
				"price": 97
			}
		]
	},
	"0": 200
}
```  

## Atualiza uma categoria

```http
  PUT /api/categories/{id}
```
```
UPDATE
- Valida se a categoria existe
- Valida os campos obrigatórios do payload
- Atualiza a categoria validada
```
```json
FORMATO DE DADOS

Payload
{
	"name": "Emagrecimento"
}

Response 200 OK
{
	"message": "Updated sucessfully",
	"data": {
		"id": 1,
		"name": "Emagrecimento"
	}
}

Response 422 Unprocessable Content
{
	"message": "Category does not exist"
}
```

## Deleta uma categoria

```http
  DELETE /api/categories/{id}
```
```
UPDATE
- Valida se a categoria existe
- Deleta a categoria
```
```json
FORMATO DE DADOS
Response 200 OK
{
	"message": "Deleted sucessfully"
}

RESPONSE 404 Not Found
{
	"message": "Category not exist"
}
```
