-- Post 1
---- tags: tag1, tag2

-- Post 2
---- tags: tag1, tag3

-- Post 3
---- tags: tag3, tag4

-- Post 4
---- tags: tag1, tag2, tag3, tag4

--- Acessando o Post 1:
Post 2 é relacionado com o post 1.
Post 4 é relacionado com o post 1.

-- Acessando Post 2:
-- Post 1 é relacionado com o post 2.
-- Post 3 é relacionado com o post 2.
-- Post 4 é relacionado com o post 2.

-- Acessando Post 3:
-- Post 2 é relacionado com o post 3.
-- Post 4 é relacionado com o post 3.

-- Acessando Post 4:
-- Post 1 é relacionado com o post 4.
-- Post 2 é relacionado com o post 4.

/api/posts/[slug]/related
