<?php

namespace JzIT\Serializer\Wrapper;

use \Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class Serializer implements SerializerInterface
{
    /**
     * @var \Symfony\Component\Serializer\SerializerInterface
     */
    protected $serializer;

    /**
     * Serializer constructor.
     *
     * @param \Symfony\Component\Serializer\SerializerInterface $serializer
     */
    public function __construct(SymfonySerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param object $data
     * @param string $format
     * @param array $context
     *
     * @return string
     */
    public function serialize(object $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    /**
     * @param string $data
     * @param string $type
     * @param string $format
     * @param array $context
     *
     * @return object
     */
    public function deserialize(string $data, string $type, string $format, array $context = []): object
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }


}
