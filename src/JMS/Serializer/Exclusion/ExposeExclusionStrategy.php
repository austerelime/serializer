<?php

namespace JMS\Serializer\Exclusion;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\Metadata\PropertyMetadata;

class ExposeExclusionStrategy implements ExclusionStrategyInterface
{
    /**
     * Whether the class should be skipped.
     *
     * @param ClassMetadata $metadata
     *
     * @return boolean
     */
    public function shouldSkipClass(ClassMetadata $metadata, Context $context)
    {
        return false;
    }

    /**
     * Whether the property should be skipped.
     *
     * @param PropertyMetadata $property
     *
     * @return boolean
     */
    public function shouldSkipProperty(PropertyMetadata $property, Context $context)
    {
        switch ($context->getDirection()) {
            case GraphNavigator::DIRECTION_SERIALIZATION:
                if (isset($property->exposeToSerialize) && $property->exposeToSerialize !== true) {
                    return true;
                }
                break;
            case GraphNavigator::DIRECTION_DESERIALIZATION:
                if (isset($property->exposeToDeserialize) && $property->exposeToDeserialize !== true) {
                    return true;
                }
                break;
        }

        return false;
    }
}
