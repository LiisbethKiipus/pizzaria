<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testPasswordUpdatePageIsDisplayed(): void
    {
        /**
         * @var Authenticatable
         */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('user-password.edit'));

        $response->assertStatus(200);
    }

    public function testPasswordCanBeUpdated(): void
    {
        /**
         * @var Authenticatable&User
         */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user-password.edit'))
            ->put(route('user-password.update'), [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('user-password.edit'));

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function testCorrectPasswordMustBeProvideToUpdatePassword(): void
    {
        /**
         * @var Authenticatable
         */
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('user-password.edit'))
            ->put(route('user-password.update'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrors('current_password')
            ->assertRedirect(route('user-password.edit'));
    }
}
