<?php

namespace Rz\CommentBundle\Admin\Entity;

use Sonata\CommentBundle\Admin\Entity\CommentAdmin as BaseCommentAdmin;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentAdmin extends BaseCommentAdmin
{
    protected $parentAssociationMapping = 'thread';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('createdAt', 'sonata_type_datetime_picker')
            ->add('body')
            ->add('email')
            ->add('website')
            ->add('state', 'sonata_comment_status', array('translation_domain' => 'SonataCommentBundle'))
            ->add('private', 'checkbox', array('required' => false))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('body')
            ->add('email')
            ->add('website')
            ->add('state')
            ->add('private')
            ->add('createdAt', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('custom', 'string', array('template' => 'RzCommentBundle:CommentAdmin:list_comment_custom.html.twig', 'label' => 'Comment'))
            ->add('createdAt', 'datetime', array('footable'=>array('attr'=>array('data-breakpoints'=>array('all')))))
            ->add('state', 'string', array('template' => 'SonataCommentBundle:CommentAdmin:list_status.html.twig', 'footable'=>array('attr'=>array('data-breakpoints'=>array('all')))))
            ->add('private', 'boolean', array('editable' => true, 'footable'=>array('attr'=>array('data-breakpoints'=>array('all')))))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistentParameters()
    {
        $parameters = parent::getPersistentParameters();
        return $parameters;
    }
}
