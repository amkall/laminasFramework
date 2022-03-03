<?php

namespace Album\Controller;

use Album\Model\AlbumTable;
use Album\Model\CantorTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\I18n\View\Helper\AbstractTranslatorHelper;
use Laminas\I18n\Translator\TranslatorAwareInterface;


// Add the following import statements at the top of the file:
use Album\Form\AlbumForm;
use Album\Model\Album;

class AlbumController extends AbstractActionController
{
        // Add this property:
    private $table;
    private $cantor;

    // Add this constructor:
    public function __construct(AlbumTable $table, CantorTable $cantor)
    {
        $this->table  = $table;
        $this->cantor = $cantor;
    }

    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->table->fetchAll(),
            'cantor' => $this->table->fetchAll(),
        ]);
    }

   /* Update the following method to read as follows: */
   public function addAction()
   {
       $form = new AlbumForm();
       $form->get('submit')->setValue('Add');

       $request = $this->getRequest();

       if (! $request->isPost()) {
           return ['form' => $form];
       }

       $album = new Album();
       $form->setInputFilter($album->getInputFilter());
       $form->setData($request->getPost());

       if (! $form->isValid()) {
           return ['form' => $form];
       }

       $album->exchangeArray($form->getData());
       $this->table->saveAlbum($album);
       return $this->redirect()->toRoute('album');
   }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}