<?php

namespace Rz\CommentBundle\Entity;

use Sonata\CommentBundle\Entity\BaseComment as AbstractedComment;

class BaseComment extends AbstractedComment
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '-';
    }
}
