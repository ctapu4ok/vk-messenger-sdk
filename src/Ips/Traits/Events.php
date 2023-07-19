<?php
namespace ctapu4ok\VkMessengerSdk\Ips\Traits;

use ctapu4ok\VkMessengerSdk\EventHandler;
use ctapu4ok\VkMessengerSdk\Tools\Utilities;
use Revolt\EventLoop;

trait Events
{
    private string $handler;
    private $instance = null;

    private array $methods;

    private function initialize(string $eventHandler): void
    {
        $this->handler = $eventHandler;
        if (!$this->instance instanceof $this->handler) {
            $this->instance = new $this->handler($this->wrapper);
        }
        $this->instance->initInternal($this->wrapper);
    }
    public function setEventHandler(string $eventHandler): void
    {
        if (!is_subclass_of($eventHandler, EventHandler::class)) {
            throw new \Exception('Wrong event handler');
        }
        $this->initialize($eventHandler);
        $this->methods = [];
        foreach (\get_class_methods($this->handler) as $get_class_method) {
            $method_name =\lcfirst(\substr($get_class_method, 2));

            $this->methods[$method_name] = $this->instance->$get_class_method(...);
        }
        Utilities::call($this->instance->startInternal())->await();

        \array_map($this->handleUpdate(...), $this->updates);
        $this->updates = [];
        $this->updates_key = 0;
        $this->startUpdateSystem();
    }

    public function getEventHandler()
    {
        return $this->handler;
    }

    /**
     * @return mixed
     */
    public function getInstance(): mixed
    {
        return $this->instance;
    }

    /**
     * @param mixed $instance
     */
    public function setInstance(mixed $instance): void
    {
        $this->instance = $instance;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }


}
