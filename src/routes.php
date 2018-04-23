<?php

return [
    ['get', '/api/v1/books', 'BooksController:index', 'Shows all the books inside books table.'],
    ['get', '/api/v1/books/{id}', 'BooksController:show', 'Show given book details from books table.'],
    ['post', '/api/v1/books', 'BooksController:store', 'Add a new book to the books table.'],
    ['put', '/api/v1/books/{id}', 'BooksController:update', 'Update given book from books table.'],
    ['delete', '/api/v1/books/{id}', 'BooksController:destroy', 'Delete given book from books table.'],
];
