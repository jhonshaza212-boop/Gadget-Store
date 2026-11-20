<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_updated_with_its_description_and_status(): void
    {
        $user = User::factory()->create();
        $user->forceFill(['role' => 'admin'])->save();

        $category = Category::create([
            'name' => 'Aksesoris',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('categories.update', $category), [
                'name' => 'Aksesoris HP',
                'descripte' => 'Aksesoris untuk ponsel',
                'status' => 'tidak aktif',
            ]);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Aksesoris HP',
            'descripte' => 'Aksesoris untuk ponsel',
            'status' => 'tidak aktif',
        ]);
    }
}
