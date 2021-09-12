<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Setting;
use App\Models\Partner;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class BopSessionApplicantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bop_session_applicant_on_accepted_should_be_assign_for_user(): void
    {
        $this->withoutExceptionHandling();

        Setting::factory()->create([
            'meta_key' => 'auto_assign_ma_user_current_id',
            'meta_value' => 0,
        ]);

        Setting::factory()->create([
            'meta_key' => 'cv_form_msg',
        ]);

        $admin_user = User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $partner = Partner::factory()->create();
        User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
            'partner_id' => $partner->id,
        ]);

        $bdm_user = User::factory()->create([
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma_user = User::factory()->create([
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm_user->id,
        ]);

        $bdm_user_2 = User::factory()->create([
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma_user_2 = User::factory()->create([
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm_user_2->id,
        ]);

        $new_status_id = Status::where('title', 'New')->first()->id;
        $applicant = Applicant::factory()->create([
            'phone' => '09796874359',
            'current_status' => 'bop_session',
            'status_id' => $new_status_id,
        ]);

        $applicant_2 = Applicant::factory()->create([
            'phone' => '09796874359',
            'current_status' => 'bop_session',
            'status_id' => $new_status_id,
        ]);

        $applicant_3 = Applicant::factory()->create([
            'phone' => '09796874359',
            'current_status' => 'bop_session',
            'status_id' => $new_status_id,
        ]);

        $this->actingAs($admin_user, 'api')->post("/api/applicants/update/{$applicant->id}", [
            'current_status' => 'pre_filter',
            'status_id' => $new_status_id,
        ]);

        $this->actingAs($admin_user, 'api')->post("/api/applicants/update/{$applicant_2->id}", [
            'current_status' => 'pre_filter',
            'status_id' => $new_status_id,
        ]);

        $this->actingAs($admin_user, 'api')->post("/api/applicants/update/{$applicant_3->id}", [
            'current_status' => 'pre_filter',
            'status_id' => $new_status_id,
        ]);

        // then
        $updated_applicant = Applicant::where('id', $applicant->id)->first();
        $this->assertEquals($updated_applicant->assign_ma_id, $ma_user->id);
        $this->assertEquals($updated_applicant->assign_bdm_id, $bdm_user->id);

        $updated_applicant_2 = Applicant::where('id', $applicant_2->id)->first();
        $this->assertEquals($updated_applicant_2->assign_ma_id, $ma_user_2->id);
        $this->assertEquals($updated_applicant_2->assign_bdm_id, $bdm_user_2->id);

        $updated_applicant_3 = Applicant::where('id', $applicant->id)->first();
        $this->assertEquals($updated_applicant_3->assign_ma_id, $ma_user->id);
        $this->assertEquals($updated_applicant->assign_bdm_id, $bdm_user->id);
    }
}
