<?php

namespace App\EventSubscriber;

// ...
use App\Repository\BookingRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly BookingRepository $bookingRepository,
        private readonly UrlGeneratorInterface $router
    ) {}

    // ...
}