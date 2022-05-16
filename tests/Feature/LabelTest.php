<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->authUser();
    }

    public function test_fetch_all_label()
    {
        $this->createLabel();
        $response = $this->getJson(route('label.index'))
            ->assertOk()
            ->json();

        $this->assertEquals(1, count($response));
    }

    public function test_user_can_create_label()
    {
        $this->authUser();
        $this->postJson(route('label.store'), [
            'title' => 'sample label title',
            'color' => 'red'
        ])->assertCreated();

        $this->assertDatabaseHas('labels', ['title' => 'sample label title']);
    }
}
