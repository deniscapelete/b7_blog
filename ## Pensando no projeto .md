## Autenticação
- Registro
-- auth/signup
-- Nome
-- Email
-- Senha
(JSON, POST)
Devolver um token de autenticação junto com os dados do usuário
{
    "user": {"id": 1, "name": "John Doe", "email": "John@gmail.com"},
     token: "alksd6a4sd685d81654648asd"
}

- Login
-- auth/signin
-- Email
-- Senha
(JSON, POST)
-- Verificar credenciais
-- Devolver token de autenticação junto com os dados do usuário
{
    "user": {"id": 1, "name": "John Doe", "email": "John@gmail.com"},
     token: "alksd6a4sd685d81654648asd"
}

- Logout
-- Invalida o token de autenticação (opcional, dependendo da implementação)
(JSON, POST)
{ "message": "Logout successful" }

- API - Página de verificação (retorna os dados do usuário autenticado)
--auth/verify
-- Token de autenticação (Header Authorization)

(POST, cabeçalho da requisição)
authorization:bearer <token>
{
    "user": {"id": 1, "name": "John Doe", "email": "John@gmail.com"},
     token: "alksd6a4sd685d81654648asd"
}
# BLOG
-- Resources
## Post
- id
- Slug
- Author (user_id)
- Title
- Content
- Cover (image)
- CreatedAt
- UpdatedAt
- Status (DRAFT, PUBLISHED, ARCHIVED)

## User
- id
- name
- email
- password
- status
## Tag
- id
- name

##post_tags
- postId
- tagId

## Página

-- Listagem de Posts

-- GET
-- /api/posts
-- Resposta:
posts: [
    {id, title, createdAt, cover, authorName, tags (separado por virgula), body, slug}
]
