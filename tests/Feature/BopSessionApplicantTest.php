<?php

namespace Tests\Feature;

use App\Applicant;
use App\Partner;
use App\Setting;
use App\Status;
use App\User;
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
    public function bopSessionApplicantOnAcceptedShouldBeAssiginForUser()
    {
        $this->withoutExceptionHandling();

        factory(Setting::class)->create([
            'meta_key' => 'auto_assign_ma_user_current_id',
            'meta_value' => 0,
        ]);

        factory(Setting::class)->create([
            'meta_key' => 'cv_form_msg',
        ]);

        $admin_user = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $partner = factory(Partner::class)->create();
        $partner_user = factory(User::class)->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
            'partner_id' => $partner->id,
        ]);

        $bdm_user = factory(User::class)->create([
            'is_admin' => 0,
            'is_bdm' => 1,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);

        $ma_user = factory(User::class)->create([
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm_user->id,
        ]);

        $ma_user_2 = factory(User::class)->create([
            'is_admin' => 0,
            'is_bdm' => 0,
            'is_ma' => 1,
            'is_staff' => 0,
            'user_id' => $bdm_user->id,
        ]);

        $new_status_id = Status::where('title', 'New')->first()->id;
        $applicant = factory(Applicant::class)->create([
            'phone' => '09796874359',
            'current_status' => 'bop_session',
            'status_id' => $new_status_id,
        ]);

        $applicant_2 = factory(Applicant::class)->create([
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

        // then
        $updated_applicant = Applicant::where('id', $applicant->id)->first();
        $this->assertEquals($updated_applicant->assign_ma_id, $ma_user->id);

        $updated_applicant_2 = Applicant::where('id', $applicant_2->id)->first();
        $this->assertEquals($updated_applicant_2->assign_ma_id, $ma_user_2->id);
    }
}
