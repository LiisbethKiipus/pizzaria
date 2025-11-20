<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestsAreRedirectedToTheLoginPage(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function testAuthenticatedUsersCanVisitTheDashboard(): void
    {
        /**
         * @var Authenticatable&User
         */
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('dashboard'))->assertOk();
    }
}
