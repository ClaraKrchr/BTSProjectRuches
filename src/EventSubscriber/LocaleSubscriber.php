<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    // Langue par d�faut
    private $defaultLocale;
    
    public function __construct($defaultLocale = 'fr')
    {
        if ($this->defaultLocale == NULL) $this->defaultLocale = $defaultLocale;
    }
    
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }
        
        // On v�rifie si la langue est pass�e en param�tre de l'URL
        if ($locale = $request->query->get('_locale')) {
            $request->setLocale($locale);
        } else {
            // Sinon on utilise celle de la session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }
    
    public static function getSubscribedEvents()
    {
        return [
            // On doit d�finir une priorit� �lev�e
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
