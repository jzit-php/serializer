<?php

namespace JzIT\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer as SymfonyDateTimeNormalizer;

class DateTimeNormalizer extends SymfonyDateTimeNormalizer
{
    /**
     * {@inheritdoc}
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        if (is_object($data) && property_exists($data, 'timestamp')){
            return (new \DateTime())->setTimestamp($data->timestamp);
        }

        return parent::denormalize($data, $type, $format, $context);
    }
}
