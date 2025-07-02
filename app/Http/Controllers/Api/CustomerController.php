<?php

namespace App\Http\Controllers\Api;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $repo = $em->getRepository(Customer::class);
        $customers = $repo->findAll();

        return response()->json(array_map(fn($c) => [
            'full_name' => $c->getFirstName() . ' ' . $c->getLastName(),
            'email' => $c->getEmail(),
            'country' => $c->getCountry(),
        ], $customers));
    }

    public function show(EntityManagerInterface $em, int $id): JsonResponse
    {
        $customer = $em->getRepository(Customer::class)->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'full_name' => $customer->getFirstName() . ' ' . $customer->getLastName(),
            'email' => $customer->getEmail(),
            'username' => $customer->getUsername(),
            'gender' => $customer->getGender(),
            'country' => $customer->getCountry(),
            'city' => $customer->getCity(),
            'phone' => $customer->getPhone(),
        ]);
    }
}
