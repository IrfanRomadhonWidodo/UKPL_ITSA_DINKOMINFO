<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Formulir;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormulirTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    /**
     * Test user can access formulir page.
     */
    public function test_user_can_access_formulir_page(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/formulir')
                ->waitUntilMissing('#loading-screen')
                ->assertPathIs('/formulir')
                ->assertSee('Formulir Permohonan ITSA');
        });
    }

    /**
     * Test validation prevents moving to next step if fields are empty (Steps 1, 2, and 3).
     */
    public function test_validation_prevents_next_step_if_empty(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/formulir')
                ->waitUntilMissing('#loading-screen')
                ->waitFor('#step-1', 5)

                // === STEP 1 VALIDATION ===
                // Try to click next without filling anything
                ->waitUntilMissing('.opacity-0#loading-screen', 10)
                ->click('#next-btn')
                ->pause(1000)

                // Should still see Step 1 and error messages
                ->assertVisible('#step-1')
                ->assertVisible('#nama_aplikasi_error')
                ->assertVisible('#domain_aplikasi_error')

                // === STEP 1 SUCCESS -> STEP 2 ===
                // Fill Step 1 Correctly
                ->type('nama_aplikasi', 'Validation Test App')
                ->type('domain_aplikasi', 'val.test.com')
                ->radio('ip_jenis', 'lokal')
                ->type('ip_address', '192.168.1.1')
                ->click('#next-btn')
                ->pause(1000)
                ->waitUntilMissing('#step-1:not(.hidden)')
                ->assertVisible('#step-2')

                // === STEP 2 VALIDATION ===
                // Try to click next without filling anything in Step 2
                ->click('#next-btn') // Next button is used for step 2 -> 3 transition as well? 
                // Based on view logic: next-btn click triggers validateCurrentStep()
                ->pause(1000)

                // Should still see Step 2 and error messages
                ->assertVisible('#step-2')
                // Check for step 2 error messages (IDs based on view analysis)
                ->assertVisible('#pejabat_nama_error')
                ->assertVisible('#pejabat_nip_error')

                // === STEP 2 SUCCESS -> STEP 3 ===
                // Fill Step 2 Correctly
                ->type('pejabat_nama', 'Pak Budi')
                ->type('pejabat_nip', '12345678')
                ->type('pejabat_pangkat', 'Gol IV/a')
                ->type('pejabat_jabatan', 'Manager')
                ->click('#next-btn')
                ->pause(1000)
                ->waitUntilMissing('#step-2:not(.hidden)')
                ->assertVisible('#step-3')

                // === STEP 3 VALIDATION ===
                // Try to click Submit/Preview without filling anything in Step 3
                // Note: On Step 3, the "Selanjutnya" button is hidden, "Preview" and "Kirim" are shown.
                // Both Preview and Submit button listeners validate the current step (step 3) first.
                // Both Preview and Submit button listeners validate the current step (step 3) first.
                ->click('#submit-btn')

                // Wait for the SweetAlert warning to appear (indicating validation failed)
                ->waitForText('Mohon lengkapi semua field yang wajib diisi', 10)

                // Close the SweetAlert to ensure no overlay blocks the view
                ->click('.swal2-confirm')
                ->waitUntilMissing('.swal2-container')

                // Should not show preview modal, should show validation errors
                ->assertMissing('#preview-modal')
                ->waitFor('#tujuan_sistem_error', 5)
                ->assertVisible('#tujuan_sistem_error')
                ->assertVisible('#pengguna_sistem_error');
        });
    }

    /**
     * Test user can submit complete formulir (Happy Path).
     */
    public function test_user_can_submit_complete_formulir(): void
    {
        $user = User::where('status', 'disetujui')->where('role', 'user')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->logout()
                ->loginAs($user)
                ->visit('/formulir')
                ->waitUntilMissing('#loading-screen')
                ->waitFor('#step-1', 5)

                // --- Step 1 ---
                ->type('nama_aplikasi', 'Dusk Test Application ' . rand(1000, 9999))
                ->type('domain_aplikasi', 'dusk.test.com')
                ->radio('ip_jenis', 'public')
                ->type('ip_address', '10.0.0.1')
                ->click('#next-btn')
                ->pause(1000)
                ->waitUntilMissing('#step-1:not(.hidden)')
                ->assertVisible('#step-2')

                // --- Step 2 ---
                ->type('pejabat_nama', 'Budi Santoso')
                ->type('pejabat_nip', '198001012000011001')
                ->type('pejabat_pangkat', 'Pembina')
                ->type('pejabat_jabatan', 'Kepala Bidang')
                ->click('#next-btn')
                ->pause(1000)
                ->waitUntilMissing('#step-2:not(.hidden)')
                ->assertVisible('#step-3')

                // --- Step 3 ---
                ->type('tujuan_sistem', 'Testing Purpose')
                ->type('pengguna_sistem', 'Internal Users')
                ->type('hosting', 'Cloud VPS')
                ->type('framework', 'Laravel 10')
                ->type('pengelola_sistem', 'IT Dept')
                ->type('jumlah_roles', '3')
                ->type('nama_roles', 'Admin, User, Manager')
                ->type('mekanisme_account', 'Self Registration')
                ->type('mekanisme_kredensial', 'JWT')
                ->radio('fitur_reset_password', '1')
                ->type('pic_pengelola', 'Andi IT')

                // Submit (Trigger Preview)
                ->click('#submit-btn')
                ->waitFor('#preview-modal', 5)
                ->assertVisible('#preview-modal')

                // Confirm in Modal
                ->click('label[for="verify-checkbox"]')
                ->pause(500)
                ->assertEnabled('#confirm-submit')
                ->click('#confirm-submit')

                // Wait for success and redirect
                ->waitForText('Berhasil!', 10)
                ->assertSee('Formulir berhasil dikirim');

            // Removed the separate view test as requested by user ("engga perlu ke halaman riwayat")
            // The success message assertion confirms the submission cycle.
        });
    }
}
