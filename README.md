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
  response()->json (Response::HTTP_OK)
```
#### Cria um produto 

```http-
  POST: /api/product
```
```
STORE
- Valida os campos obrigatórios do produto(nome,descrição, preço)
- Verifica se o produto já foi criado
- Cria o produto e armazena no banco de dados
```
```
FORMATO DE DADOS
  response()->json (Response::HTTP_CREATED)
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
  response()->json (Response::HTTP_OK)
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
  response()->json (Response::HTTP_OK)
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
  response()->json (Response::HTTP_OK)
```
  
