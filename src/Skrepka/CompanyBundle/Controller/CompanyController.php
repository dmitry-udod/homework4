<?php

namespace Skrepka\CompanyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Skrepka\CompanyBundle\Document\Company;
use Skrepka\CompanyBundle\Form\CompanyType;

class CompanyController extends Controller
{
    /**
     * Lists all Company documents.
     *
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        $documents = $this->get('company_manager')->all();

        return ['documents' => $documents];
    }

    /**
     * Displays a form to create a new Company document.
     *
     * @Template()
     *
     * @return array
     */
    public function newAction()
    {
        $document = new Company();
        $form = $this->createForm(new CompanyType(), $document);

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Creates a new Company document.
     *
     * @Template("CompanyBundle:Company:new.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function createAction(Request $request)
    {
        $document = new Company();
        $form     = $this->createForm(new CompanyType(), $document);
        $form->bind($request);

        if ($form->isValid()) {
            $dm = $this->getDocumentManager();
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('company_show', ['slug' => $document->getSlug()]));
        }

        return array(
            'document' => $document,
            'form'     => $form->createView()
        );
    }

    /**
     * Finds and displays a Company document.
     *
     * @Template()
     *
     * @param string $slug The document ID
     * @return array
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If document doesn't exists
     */
    public function showAction($slug)
    {
        $document = $this->get('company_repository')->findBySlug($slug);

        if (!$document) {
            throw $this->createNotFoundException('now_company_with_this_slug');
        }

        $deleteForm = $this->createDeleteForm($document->getId());

        return array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Company document.
     *
     * @Route("/{id}/edit", name="company_edit")
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

        $document = $dm->getRepository('CompanyBundle:Company')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Company document.');
        }

        $editForm = $this->createForm(new CompanyType(), $document);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Company document.
     *
     * @Route("/{id}/update", name="company_update")
     * @Method("POST")
     * @Template("CompanyBundle:Company:edit.html.twig")
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

        $document = $dm->getRepository('CompanyBundle:Company')->find($id);

        if (!$document) {
            throw $this->createNotFoundException('Unable to find Company document.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm   = $this->createForm(new CompanyType(), $document);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $dm->persist($document);
            $dm->flush();

            return $this->redirect($this->generateUrl('company_edit', array('id' => $id)));
        }

        return array(
            'document'    => $document,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Company document.
     *
     * @Route("/{id}/delete", name="company_delete")
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
            $document = $dm->getRepository('CompanyBundle:Company')->find($id);

            if (!$document) {
                throw $this->createNotFoundException('Unable to find Company document.');
            }

            $dm->remove($document);
            $dm->flush();
        }

        return $this->redirect($this->generateUrl('company'));
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
