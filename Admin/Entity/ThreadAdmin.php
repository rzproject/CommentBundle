<?php

namespace Rz\CommentBundle\Admin\Entity;

use Sonata\CommentBundle\Admin\Entity\ThreadAdmin as BaseThreadAdmin;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ThreadAdmin extends BaseThreadAdmin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('id');

        if (interface_exists('Sonata\\ClassificationBundle\\Model\\CategoryInterface')) {
            $formMapper->add('category');
        }

        $formMapper
            ->add('permalink')
            ->add('isCommentable')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');

        if (interface_exists('Sonata\\ClassificationBundle\\Model\\CategoryInterface')) {
            $datagridMapper->add('category');
        }

        $datagridMapper
            ->add('permalink')
            ->add('isCommentable')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');

        if (interface_exists('Sonata\\ClassificationBundle\\Model\\CategoryInterface')) {
            $listMapper->add('category', 'text', array('footable'=>array('attr'=>array('data-breakpoints'=>array('all')))));
        }

        $listMapper
            ->add('permalink', 'text', array('footable'=>array('attr'=>array('data-breakpoints'=>array('all')))))
            ->add('isCommentable', 'boolean', array('editable' => true, 'footable'=>array('attr'=>array('data-breakpoints'=>array('xs', 'sm')))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            $this->trans('sonata_comment_admin_edit'),
            array('uri' => $admin->generateUrl('edit', array('id' => $id)))
        );

        $menu->addChild(
            $this->trans('sonata_comment_admin_view_comments'),
            array('uri' => $admin->generateUrl('sonata.comment.admin.thread|sonata.comment.admin.comment.list', array('id' => $id)))
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        if ($this->subject === null && $this->request) {
            $id = $this->request->get($this->getIdParameter());
            $this->subject = $this->getModelManager()->find($this->getClass(), $id);
        }

        return $this->subject;
    }
}
