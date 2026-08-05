<?php

namespace Tests\Feature\Filament;

use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    public function test_guests_can_reach_the_admin_login(): void
    {
        $this->get('/admin')
            ->assertRedirect('/admin/login');

        $login = $this->get('/admin/login');

        $login
            ->assertOk()
            ->assertSee('Prometeo Workshop')
            ->assertSee('Entre a su cuenta')
            ->assertSee('css/filament/filament/app.css', escape: false)
            ->assertDontSee('bootstrap.min.css', escape: false);

        $this->assertSame('es', app()->getLocale());
        $this->assertSame('Europe/Madrid', config('app.timezone'));
    }

    public function test_the_admin_panel_does_not_expose_public_registration(): void
    {
        $this->assertFalse(Route::has('filament.admin.auth.register'));
    }

    public function test_the_admin_panel_uses_the_logo_blue_as_its_primary_color(): void
    {
        $this->assertSame(
            Color::hex('#3A53CD'),
            Filament::getPanel('admin')->getColors()['primary'],
        );
    }

    public function test_the_legacy_login_remains_available(): void
    {
        $this->get('/login')->assertOk();
    }
}
