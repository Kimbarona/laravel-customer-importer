<?php

namespace App\Services;
use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CustomerImporter
{
    protected ?Command $command;
    public function __construct(
        private EntityManagerInterface $em,
        ?Command $command = null
    ) {
        $this->command = $command;
    }

    public function import(int $count = 100): void
    {

        $url = config('services.randomuser.url');

        if (!$url) {
            if ($this->command) {
                $this->command->error('RandomUser API URL is not configured.');
            }
            return;
        }

        $response = Http::get($url, [
            'results' => 100,
            'nat' => config('customer.default_nationality'),
        ]);

        if (!$response->successful()) {
            throw new \Exception("Failed to fetch data.");
        }

        foreach ($response->json('results') as $user) {
            if (($user['nat'] ?? '') !== config('customer.default_nationality')) {
                continue;
            }

            $repo = $this->em->getRepository(Customer::class);
            $customer = $repo->findOneBy(['email' => $user['email']]) ?? new Customer();

            $customer->setFirstName($user['name']['first']);
            $customer->setLastName($user['name']['last']);
            $customer->setEmail($user['email']);
            $customer->setUsername($user['login']['username']);
            $customer->setGender($user['gender']);
            $customer->setCountry($user['location']['country']);
            $customer->setCity($user['location']['city']);
            $customer->setPhone($user['phone']);
            $customer->setPassword(md5($user['login']['password']));

            $this->em->persist($customer);
        }

        $this->em->flush();
    }
}
