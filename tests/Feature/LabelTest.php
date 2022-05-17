<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
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
        $label = Label::factory()->raw();

        $this->postJson(route('label.store'), $label)->assertCreated();

        $this->assertDatabaseHas('labels', ['title' => $label['title'], 'color' => $label['color']]);
    }

    public function test_user_can_delete_label()
    {
        $label = $this->createLabel();

        $this->deleteJson(route('label.destroy', $label->id))->assertNoContent();

        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
