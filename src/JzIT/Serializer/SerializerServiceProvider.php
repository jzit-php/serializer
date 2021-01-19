<?php

declare(strict_types=1);

namespace JzIT\Serializer;

use Di\Container;
use JzIT\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Class SerializerServiceProvider
 *
 * @package JzIT\Serializer
 *
 * @method \JzIT\Serializer\SerializerFactory getFactory(?string $className = null)
 */
class SerializerServiceProvider extends AbstractServiceProvider
{
    /**
     * @param \Di\Container $container
     */
    public function register(Container $container): void
    {
        $this->registerSerializer($container);
    }

    /**
     * @param \Di\Container $container
     *
     * @return \JzIT\Serializer\SerializerServiceProvider
     */
    protected function registerSerializer(Container $container): SerializerServiceProvider
    {
        $self = $this;

        $container->set(SerializerConstants::CONTAINER_SERVICE_NAME, function () use ($self) {
            return $self->getFactory()->createSerializer();
        });

        return $this;
    }
}
