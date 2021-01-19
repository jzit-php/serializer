<?php

namespace JzIT\Serializer\Wrapper;

interface SerializerInterface
{
    /**
     * @param object $data
     * @param string $format
     * @param array $context
     *
     * @return string
     */
    public function serialize(object $data, string $format, array $context = []): string;

    /**
     * @param string $data
     * @param string $type
     * @param string $format
     * @param array $context
     *
     * @return object
     */
    public function deserialize(string $data, string $type, string $format, array $context = []): object;
}
