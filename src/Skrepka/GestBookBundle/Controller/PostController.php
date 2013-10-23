<?php

namespace Skrepka\GestBookBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Skrepka\GestBookBundle\Document\Post;
use Skrepka\GestBookBundle\Form\PostType;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Lists all Post documents.
     *
     * @Route("/", name="post")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $dm = $this->getDocumentManager();

        $documents = $dm->getRepository('GuestBookBundle:Post')->findAll();

        return array('documents' => $documents);
    }

    /**
     * Displays a form to create a new Post document.
     *
     * @Route("/new", name="post_new")
     * @Template()
     *
     * @return array
     */
    public function newAction()
    {
        $document = new Post();
        $form = $this->createForm(new PostType(), $document);

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Creates a new Post document.
     *
     * @Route("/create", name="post_create")
     * @Method("POST")
     * @Template("GuestBookBundle:Post:new.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function createAction(Request $request)
    {
        $document = new Post();
        $form     = $this->createForm(new PostType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $document->getId())));
        }

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Finds and displays a Post document.
     *
     * @Route("/{id}/show", name="post_show")
     * @Template()
     *
     * @param string $id The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function showAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('GuestBookBundle:Post')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Post document.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Post document.
     *
     * @Route("/{id}/edit", name="post_edit")
     * @Template()
     *
     * @param string $id The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function editAction($id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('GuestBookBundle:Post')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Post document.');
        }

        $editForm = $this->createForm(new PostType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Post document.
     *
     * @Route("/{id}/update", name="post_update")
     * @Method("POST")
     * @Template("GuestBookBundle:Post:edit.html.twig")
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function updateAction(Request $request, $id)
    {
        $dm = $this->getDocumentManager();

        $document = $dm->getRepository('GuestBookBundle:Post')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Post document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new PostType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Post document.
     *
     * @Route("/{id}/delete", name="post_delete")
     * @Method("POST")
     *
     * @param Request $request The request object
     * @param string $id       The document ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $document = $dm->getRepository('GuestBookBundle:Post')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Post document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Returns the DocumentManager
     *
     * @return DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->get('doctrine.odm.mongodb.document_manager');
    }
}
