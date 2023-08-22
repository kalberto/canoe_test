<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class FundControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetAllFunds()
    {
        $this->createFunds();

        $response = $this->getJson('api/funds')->assertStatus(Response::HTTP_OK)->json('data');

        $this->assertEquals(5, count($response));
    }

    public function testCanCreateFund()
    {
        $manager = $this->createManager();

        $response = $this->postJson('api/funds', [
            'name' => 'FUND NAME',
            'manager_id' => $manager->id,
            'start_year' => 2020,
        ])->assertStatus(Response::HTTP_CREATED)->json('data');

        $this->assertEquals('FUND NAME', $response['name']);
    }

    public function testCanCreateFundWithAlias()
    {
        $manager = $this->createManager();

        $response = $this->postJson('api/funds', [
            'name' => 'FUND NAME 2',
            'manager_id' => $manager->id,
            'start_year' => 2020,
            'aliases' => ['test alias'],
        ])->assertStatus(Response::HTTP_CREATED)->json('data');

        $this->assertEquals('TEST ALIAS', $response['aliases'][0]);
    }

    public function testCanReturnDuplicatedFunds()
    {
        $manager = $this->createManager();

        $this->postJson('api/funds', [
            'name' => 'FUND WEIRD NAME',
            'manager_id' => $manager->id,
            'start_year' => 2020,
            'aliases' => ['test alias'],
        ])->assertStatus(Response::HTTP_CREATED)->json('data');

        $this->postJson('api/funds', [
            'name' => 'FUND WEIRD NAME',
            'manager_id' => $manager->id,
            'start_year' => 2020,
            'aliases' => ['test alias'],
        ])->assertStatus(Response::HTTP_CREATED)->json('data');

        $response = $this->getJson('api/funds/duplicated')->assertStatus(Response::HTTP_OK)->json('data');

        $this->assertEquals('FUND WEIRD NAME', $response[0]['name']);
        $this->assertEquals('FUND WEIRD NAME', $response[1]['name']);
    }
}
