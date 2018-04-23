<?php

namespace App\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Slim\Http\Request;
use Slim\Http\Response;

class BooksController extends AbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $books = Book::all();
        
        return $response->withJson($books);
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function show(Request $request, Response $response): Response
    {
        try {
            $book = Book::findOrFail($request->getAttribute('id'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $response->withStatus(404);
        }
        
        return $response->withJson($book);
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function store(Request $request, Response $response): Response
    {
        try {
            Book::create($request->getParsedBodyParam('name'));
        } catch (\PDOException $exception) {
            $this->container->get('logger')->error($exception);
            
            return $response->withStatus(500);
        } catch (\Exception $exception) {
            $this->container->get('logger')->error($exception);

            return $response->withStatus(500);
        }

        return $response->withStatus(201);
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function update(Request $request, Response $response): Response
    {
        try {
            $book = Book::findOrFail($request->getAttribute('id'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $response->withStatus(404);
        }
        
        try {
            $book->update($request->getParsedBodyParam('name'));
        } catch (QueryException $queryException) {
            $this->container->get('logger')->error('An error encountered while updating book.',
                ['name' => $request->getAttribute('name')]
            );
            
            return $response->withStatus(500);
        }
        
        return $response->withStatus(204);
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function destroy(Request $request, Response $response): Response
    {
        try {
            $book = Book::findOrFail($request->getAttribute('id'));
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $response->withStatus(404);
        }
        
        if (!$book->delete()) {
            $this->container->get('logger')->error('An error encountered while updating book.',
                ['id' => $request->getAttribute('id')]
            );
            
            return $response->withStatus(500);
        }
        
        return $response->withStatus(204);
    }
}
