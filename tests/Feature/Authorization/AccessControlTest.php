<?php

namespace Tests\Feature\Authorization;

use App\Models\Bar;
use App\Models\DeliveryNote;
use App\Models\Factory;
use App\Models\Local;
use App\Models\Machine;
use App\Models\PrometeoSyncRun;
use App\Models\SparePart;
use App\Models\SparePartStateHistory;
use App\Models\State;
use App\Models\User;
use App\Policies\AuthenticatedUserPolicy;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_authenticated_user_can_access_the_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(FilamentUser::class, $user);
        $this->assertTrue($user->canAccessPanel(Filament::getPanel('admin')));

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();
    }

    public function test_guests_cannot_access_the_legacy_crud_pages(): void
    {
        foreach (['/home', '/factories', '/spareparts', '/deliverynotes'] as $uri) {
            $this->get($uri)->assertRedirect('/login');
        }
    }

    public function test_the_authenticated_user_can_access_the_legacy_crud_pages(): void
    {
        $this->actingAs(User::factory()->create());

        foreach (['/home', '/factories', '/spareparts', '/deliverynotes'] as $uri) {
            $this->get($uri)->assertOk();
        }
    }

    public function test_public_registration_is_disabled(): void
    {
        $this->assertFalse(Route::has('register'));
        $this->get('/register')->assertNotFound();
        $this->post('/register')->assertNotFound();
    }

    public function test_every_workshop_model_has_a_complete_policy(): void
    {
        $user = User::factory()->create();

        $models = [
            Bar::class,
            DeliveryNote::class,
            Factory::class,
            Local::class,
            Machine::class,
            PrometeoSyncRun::class,
            SparePart::class,
            SparePartStateHistory::class,
            State::class,
        ];

        foreach ($models as $modelClass) {
            $policy = Gate::getPolicyFor($modelClass);
            $record = new $modelClass;
            $gate = Gate::forUser($user);

            $readOnlyModels = [
                Bar::class,
                Local::class,
                Machine::class,
                PrometeoSyncRun::class,
                SparePartStateHistory::class,
            ];

            $this->assertInstanceOf(AuthenticatedUserPolicy::class, $policy);

            foreach (['viewAny', 'create', 'forceDeleteAny', 'restoreAny', 'reorder'] as $ability) {
                $this->assertSame(
                    $ability === 'viewAny' || ! in_array($modelClass, $readOnlyModels, true),
                    $gate->allows($ability, $modelClass),
                );
            }

            $this->assertSame(
                ! in_array($modelClass, [Factory::class, State::class, ...$readOnlyModels], true),
                $gate->allows('deleteAny', $modelClass),
            );

            foreach (['view', 'update', 'delete', 'forceDelete', 'restore', 'replicate'] as $ability) {
                $this->assertSame(
                    $ability === 'view' || ! in_array($modelClass, $readOnlyModels, true),
                    $gate->allows($ability, $record),
                );
            }
        }
    }
}
