<?php

namespace Tests\Feature;

use App\Models\TemplateForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TemplateFormTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'is_admin' => 1,
            'is_bdm' => 0,
            'is_ma' => 0,
            'is_staff' => 0,
        ]);
    }

    /**
     * @test
     * @dataProvider requiredFormValidationProvider
     * @param $formInput
     * @param $formInputValue
     */
    public function it_validates_form($formInput, $formInputValue)
    {
        $this->actingAs($this->admin)->post(route('templateforms.store'), [$formInput => $formInputValue])
              ->assertSessionHasErrors($formInput);
    }

    public function requiredFormValidationProvider()
    {
        return [
            ['template_name', ''],
            ['preferred_name', 'some-string'],
            ['name', 'some-string'],
            ['nrc', 'some-string'],
            ['nrc_photo', 'some-string'],
            ['dob', 'some-string'],
            ['gender', 'some-string'],
            ['myanmar_citizen', 'some-string'],
            ['citizenship', 'some-string'],
            ['race', 'some-string'],
            ['marital_status', 'some-string'],
            ['address', 'some-string'],
            ['city', 'some-string'],
            ['township', 'some-string'],
            ['contact_no', 'some-string'],
            ['alternate_no', 'some-string'],
            ['highest_qualification', 'some-string'],
            ['email', 'some-string'],
            ['conflict_interest', 'some-string'],
            ['term_condition', 'some-string'],
        ];
    }

    /** @test */
    public function admin_can_create_template_form_without_additional_info()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->admin)->post(route('templateforms.store'), [
            'template_name' => 'Template Title',
            'preferred_name' => 1,
            'name' => 1,
            'nrc' => 1,
            'nrc_photo' => 1,
            'dob' => 1,
            'gender' => 1,
            'myanmar_citizen' => 1,
            'citizenship' => 1,
            'race' => 1,
            'marital_status' => 1,
            'address' => 1,
            'city' => 1,
            'township' => 1,
            'contact_no' => 1,
            'alternate_no' => 1,
            'highest_qualification' => 1,
            'email' => 1,
            'conflict_interest' => 1,
            'term_condition' => 1,
        ]);

        $response->assertStatus(302);

        $template = TemplateForm::find(1);
        $this->assertEquals(1, $template->preferred_name);
        $this->assertEquals(1, $template->name);
        $this->assertEquals(1, $template->nrc);
        $this->assertEquals(1, $template->nrc_photo);
        $this->assertEquals(1, $template->dob);
        $this->assertEquals(1, $template->gender);
        $this->assertEquals(1, $template->myanmar_citizen);
        $this->assertEquals(1, $template->citizenship);
        $this->assertEquals(1, $template->race);
        $this->assertEquals(1, $template->marital_status);
        $this->assertEquals(1, $template->address);
        $this->assertEquals(1, $template->city);
        $this->assertEquals(1, $template->township);
        $this->assertEquals(1, $template->contact_no);
        $this->assertEquals(1, $template->alternate_no);
        $this->assertEquals(1, $template->highest_qualification);
        $this->assertEquals(1, $template->email);
        $this->assertEquals(1, $template->conflict_interest);
        $this->assertEquals(1, $template->term_condition);
        $this->assertEquals([], $template->additional_info);
        $this->assertEquals(0, $template->active);
    }

    /** @test */
    public function admin_can_create_template_form_with_additional_info()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->admin)->post(route('templateforms.store'), [
            'template_name' => 'Template Title',
            'preferred_name' => 1,
            'name' => 1,
            'nrc' => 1,
            'nrc_photo' => 1,
            'dob' => 1,
            'gender' => 1,
            'myanmar_citizen' => 1,
            'citizenship' => 1,
            'race' => 1,
            'marital_status' => 1,
            'address' => 1,
            'city' => 1,
            'township' => 1,
            'contact_no' => 1,
            'alternate_no' => 1,
            'highest_qualification' => 1,
            'email' => 1,
            'conflict_interest' => 1,
            'term_condition' => 1,
            'additional_info' => ['Field Name 1', 'Field Name 2']
        ]);

        $response->assertStatus(302);

        $template = TemplateForm::find(1);
        $this->assertEquals(1, $template->preferred_name);
        $this->assertEquals(1, $template->name);
        $this->assertEquals(1, $template->nrc);
        $this->assertEquals(1, $template->nrc_photo);
        $this->assertEquals(1, $template->dob);
        $this->assertEquals(1, $template->gender);
        $this->assertEquals(1, $template->myanmar_citizen);
        $this->assertEquals(1, $template->citizenship);
        $this->assertEquals(1, $template->race);
        $this->assertEquals(1, $template->marital_status);
        $this->assertEquals(1, $template->address);
        $this->assertEquals(1, $template->city);
        $this->assertEquals(1, $template->township);
        $this->assertEquals(1, $template->contact_no);
        $this->assertEquals(1, $template->alternate_no);
        $this->assertEquals(1, $template->highest_qualification);
        $this->assertEquals(1, $template->email);
        $this->assertEquals(1, $template->conflict_interest);
        $this->assertEquals(1, $template->term_condition);
        $this->assertCount(2, $template->additional_info);
        $this->assertEquals(0, $template->active);
    }

    /** @test */
    public function admin_can_update_template_form()
    {
        $this->withoutExceptionHandling();

        $template = TemplateForm::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('templateforms.update', $template->id), [
            'template_name' => 'Template Title Updated',
            'preferred_name' => 1,
            'name' => 1,
            'nrc' => 1,
            'nrc_photo' => 1,
            'dob' => 1,
            'gender' => 1,
            'myanmar_citizen' => 0,
            'citizenship' => 0,
            'race' => 1,
            'marital_status' => 1,
            'address' => 1,
            'city' => 1,
            'township' => 1,
            'contact_no' => 1,
            'alternate_no' => 1,
            'highest_qualification' => 1,
            'email' => 1,
            'conflict_interest' => 1,
            'term_condition' => 1,
            'additional_info' => ['Field Name 1', 'Field Name 2']
        ]);

        $response->assertStatus(302);

        $updated_template = TemplateForm::find($template->id);
        $this->assertEquals(1, $updated_template->preferred_name);
        $this->assertEquals(1, $updated_template->name);
        $this->assertEquals(1, $updated_template->nrc);
        $this->assertEquals(1, $updated_template->nrc_photo);
        $this->assertEquals(1, $updated_template->dob);
        $this->assertEquals(1, $updated_template->gender);
        $this->assertEquals(0, $updated_template->myanmar_citizen);
        $this->assertEquals(0, $updated_template->citizenship);
        $this->assertEquals(1, $updated_template->race);
        $this->assertEquals(1, $updated_template->marital_status);
        $this->assertEquals(1, $updated_template->address);
        $this->assertEquals(1, $updated_template->city);
        $this->assertEquals(1, $updated_template->township);
        $this->assertEquals(1, $updated_template->contact_no);
        $this->assertEquals(1, $updated_template->alternate_no);
        $this->assertEquals(1, $updated_template->highest_qualification);
        $this->assertEquals(1, $updated_template->email);
        $this->assertEquals(1, $updated_template->conflict_interest);
        $this->assertEquals(1, $updated_template->term_condition);
        $this->assertCount(2, $updated_template->additional_info);
        $this->assertEquals(0, $updated_template->active);
    }
}
