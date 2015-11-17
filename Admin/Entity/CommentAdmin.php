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
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('body', 'text')
            ->add('createdAt', 'datetime')
            ->add('note', 'float')
            ->add('state', 'string', array('template' => 'SonataCommentBundle:CommentAdmin:list_status.html.twig'))
            ->add('private', 'boolean', array('editable' => true))
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
