<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueApiTransport;
use Symfony\Component\Mailer\Transport\AbstractTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class BrevoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['mailer']->getSymfonyTransport()->getFactory()
            ->add(new class extends AbstractTransportFactory {
                protected function getSupportedSchemes(): array
                {
                    return ['brevo'];
                }

                public function create(Dsn $dsn)
                {
                    return new SendinblueApiTransport(env('BREVO_API_KEY'));
                }
            });
    }
}
