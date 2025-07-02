<?php

namespace Tests\Feature;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Tests\TestCase;

class CustomerImporterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        /** @var EntityManagerInterface $em */
        $em = app(EntityManagerInterface::class);

        // Generate schema for all Doctrine entities
        $tool = new SchemaTool($em);
        $classes = $em->getMetadataFactory()->getAllMetadata();

        if (!empty($classes)) {
            $tool->dropSchema($classes); // optional: reset tables
            $tool->createSchema($classes); // required: creates the tables
        }
    }

    public function test_successful_customer_import()
    {

        // Example: simulate import (call the method or console command)
        $this->artisan('import:customers', ['count' => 1])
            ->expectsOutput('Importing...')
            ->expectsOutput('Import completed.')
            ->assertExitCode(0);

        /** @var EntityManagerInterface $em */
        $em = app(EntityManagerInterface::class);
        $repo = $em->getRepository(Customer::class);

        $customer = $repo->findOneBy([]);
        $this->assertNotNull($customer);
        $this->assertNotEmpty($customer->getEmail());
    }

    public function test_customer_import_fails_with_invalid_api_response()
    {
        // Fake the external API response with invalid (empty) data
        \Illuminate\Support\Facades\Http::fake([
            'https://randomuser.me/*' => \Illuminate\Support\Facades\Http::response([], 200),
        ]);

        $this->artisan('import:customers', ['count' => 1])
            ->expectsOutput('Importing...')
            ->expectsOutputToContain('Failed to import customer')
            ->assertExitCode(\Symfony\Component\Console\Command\Command::FAILURE);

        // Verify no customer was created
        $em = app(EntityManagerInterface::class);
        $repo = $em->getRepository(Customer::class);

        $this->assertNull($repo->findOneBy([])); // database should be empty
    }

}
