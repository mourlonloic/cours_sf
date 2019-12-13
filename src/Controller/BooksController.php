<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    public function index()
    {
        return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController'
        ]);
    }

    /**
     * @Route("/create", name="create_book")
     */
    public function create(Request $request)
    {
        // Create a new book
        $book = new Books;

        // Define $errors array
        $errors = [];

        // Create a new form
        $form = $this->createForm(BooksType::class, $book);

        // Handle the request (request method === post)
        $form->handleRequest($request);
        
        // On form submit
        if ($form->isSubmitted())
        {
            // Handle form errors
            // ...

            // If the form is valid
            if($form->isValid())
            {
                // Save in database
                $em = $this->getDoctrine()->getManager();
                $em->persist($book);
                $em->flush();
                
                // Redirect the user
                return $this->redirectToRoute('books:read', [
                    'id' => $book->getId()
                ]);
            }
        }

        // Create the form view
        $form = $form->createView();
        
        return $this->render('books/create.html.twig', [
            "form" => $form
        ]);
    }

    public function read()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
