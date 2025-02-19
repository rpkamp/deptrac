<?php

declare(strict_types=1);

namespace Tests\SensioLabs\Deptrac\Subscriber;

use PHPUnit\Framework\TestCase;
use SensioLabs\Deptrac\AstRunner\Event\PreCreateAstMapEvent;
use SensioLabs\Deptrac\Subscriber\ConsoleSubscriber;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ConsoleSubscriberTest extends TestCase
{
    public function testOnPreCreateAstMapEventWithVerboseVerbosity(): void
    {
        $dispatcher = new EventDispatcher();
        $formatter = new BufferedOutput(OutputInterface::VERBOSITY_VERBOSE);

        $dispatcher->addSubscriber(new ConsoleSubscriber($formatter));

        $dispatcher->dispatch(new PreCreateAstMapEvent(9999999));
        $result = $formatter->fetch();

        static::assertStringContainsString('9999999', $result);
    }
}
