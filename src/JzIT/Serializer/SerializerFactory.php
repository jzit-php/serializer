<?php

namespace JzIT\Serializer;

use JzIT\Kernel\AbstractFactory;
use JzIT\Pid\Business\PidFacade;
use JzIT\Pid\Business\PidFacadeInterface;
use JzIT\Pid\Persistence\PidRepository;
use JzIT\Pid\Persistence\PidRepositoryInterface;
use JzIT\PidApi\Controller\GetController;
use JzIT\PidApi\Controller\PostController;
use JzIT\PidApi\Processor\PostProcessor;
use JzIT\PidApi\Processor\PostProcessorInterface;
use JzIT\Serializer\Wrapper\Serializer;
use JzIT\Serializer\Wrapper\SerializerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

/**
 * Class PidFactory
 *
 * @package JzIT\Pid
 * @method \JzIT\PidApi\PidApiConfig getConfig()
 */
class SerializerFactory extends AbstractFactory
{
    /**
     * @return \JzIT\Serializer\Wrapper\SerializerInterface
     */
    public function createSerializer(): SerializerInterface
    {
        return new Serializer($this->createSymfonySerializer());
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    protected function createSymfonySerializer(): SymfonySerializer
    {
        return new SymfonySerializer($this->getNormalizer(), array_merge($this->getEncoder(), $this->getDecoder()));
    }

    /**
     * @return \Symfony\Component\Serializer\Normalizer\NormalizerInterface[]
     */
    protected function getNormalizer(): array
    {
        return [
            $this->createObjectNormalizer(),
            $this->createJsonSerializableNormalizer(),
            $this->createArrayNormalizer(),
        ];
    }

    /**
     * @return \Symfony\Component\Serializer\Encoder\EncoderInterface[]
     */
    protected function getEncoder(): array
    {
        return [
            $this->createXmlEncoder(),
            $this->createJsonEncoder(),
        ];
    }

    /**
     * @return \Symfony\Component\Serializer\Encoder\EncoderInterface[]
     */
    protected function getDecoder(): array
    {
        return [
            $this->createJsonDecoder(),
        ];
    }

    /**
     * @return \Symfony\Component\Serializer\Normalizer\NormalizerInterface
     */
    protected function createObjectNormalizer(): NormalizerInterface
    {
        return new ObjectNormalizer(
            null,
            null,
            null,
            new PhpDocExtractor()
        );
    }

    /**
     * @return \Symfony\Component\Serializer\Normalizer\NormalizerInterface
     */
    protected function createJsonSerializableNormalizer(): NormalizerInterface
    {
        return new JsonSerializableNormalizer();
    }

    /**
     * @return \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer
     */
    protected function createArrayNormalizer(): ArrayDenormalizer
    {
        return new ArrayDenormalizer();
    }

    /**
     * @return \Symfony\Component\Serializer\Encoder\EncoderInterface
     */
    protected function createXmlEncoder(): EncoderInterface
    {
        return new XmlEncoder();
    }

    /**
     * @return \Symfony\Component\Serializer\Encoder\EncoderInterface
     */
    protected function createJsonEncoder(): EncoderInterface
    {
        return new JsonEncode();
    }

    /**
     * @return \Symfony\Component\Serializer\Encoder\DecoderInterface
     */
    protected function createJsonDecoder(): DecoderInterface
    {
        return new JsonDecode();
    }
}
