<?php

namespace Vich\UploaderBundle\EventListener\Doctrine;

use Doctrine\Common\EventSubscriber;

use Vich\UploaderBundle\Adapter\AdapterInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Metadata\MetadataReader;
use Vich\UploaderBundle\Util\ClassUtils;

/**
 * BaseListener
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
abstract class BaseListener implements EventSubscriber
{
    /**
     * @var string
     */
    protected $mapping;

    /**
     * @var AdapterInterface $adapter
     */
    protected $adapter;

    /**
     * @var MetadataReader $metadata
     */
    protected $metadata;

    /**
     * @var UploaderHandler $handler
     */
    protected $handler;

    /**
     * Constructs a new instance of UploaderListener.
     *
     * @param string           $mapping  The mapping name.
     * @param AdapterInterface $adapter  The adapter.
     * @param MetadataReader   $metadata The metadata reader.
     * @param UploaderHandler  $handler  The upload handler.
     */
    public function __construct($mapping, AdapterInterface $adapter, MetadataReader $metadata, UploadHandler $handler)
    {
        $this->mapping = $mapping;
        $this->adapter = $adapter;
        $this->metadata = $metadata;
        $this->handler = $handler;
    }

    /**
     * Checks if the given object is uploadable using the current mapping.
     *
     * @param mixed $object The object to test.
     *
     * @return bool
     */
    protected function isUploadable($object)
    {
        return $this->metadata->isUploadable(ClassUtils::getClass($object), $this->mapping);
    }
}