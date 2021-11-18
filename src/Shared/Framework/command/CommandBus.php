<?php


namespace TechnicalTest\Shared\Framework\command;


use function get_class;

class CommandBus
{
    public static function dispatch(CommandInterface $command): void
    {
        $key = get_class($command);
        $commandHandlerName = str_replace('Command', 'Handler', $key);

        /** @var CommandHandlerInterface $handler */
        $handler = new $commandHandlerName();
        $handler->__invoke($command);
    }
}