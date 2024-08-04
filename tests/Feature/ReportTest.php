<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ReportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_report_it_success_to_list_thong_ke_nap()
    { 
        $data = [
            'Ngay_batdau'=>'',
            'Ngay_ketthuc'=>'',
        ];
        $user = User::factory() ->create(['sRole' => 'author']);
        $response = $this->actingAs($user)->post(route('Report.thongke_nap'));
         dd($response->getContent());
         $response->assertStatus(200);
         $response->assertStatus(200)->assertJson([
            'status' => 1,
            'message' => 'Tạo báo cáo thành công TNP đã gửi báo cáo về mail của bạn',
        ]);

        // $response->assertStatus(200)->assertViewIs('admincp.admin_page.admin_xetduyet_tacpham');
    }
    public function test_report_it_success_to_list_thong_ke_rut()
    { 
        $data = [
            'Thang_bao_cao'=>'',
        ];
        $user = User::factory() ->create(['sRole' => 'admin']);
        $response = $this->actingAs($user)->post(route('Report.thongke_ruttien'), $data);
        //  dd($response->getContent());
         $response->assertStatus(200);
         $response->assertStatus(200)->assertJson([
            'status' => 1,
            'message' => 'Tạo báo cáo thành công TNP đã gửi báo cáo về mail của bạn',
        ]);

        // $response->assertStatus(200)->assertViewIs('admincp.admin_page.admin_xetduyet_tacpham');
    }
    public function test_report_it_success_to_list_thong_ke_tac_gia()
    { 
        $data = [
            'Thang_bao_cao'=>'',
        ];
        $user = User::factory() ->create(['sRole' => 'admin']);
        $response = $this->actingAs($user)->post(route('Report.thongke_ruttien'), $data);
        //  dd($response->getContent());
         $response->assertStatus(200);
         $response->assertStatus(200)->assertJson([
            'status' => 1,
            'message' => 'Tạo báo cáo thành công TNP đã gửi báo cáo về mail của bạn',
        ]);

        // $response->assertStatus(200)->assertViewIs('admincp.admin_page.admin_xetduyet_tacpham');
    }
    public function test_report_it_success_to_list_thong_ke_tac_pham()
    { 
        $data = [
            'Thang_bao_cao'=>'',
        ];
        $user = User::factory() ->create(['sRole' => 'admin']);
        $response = $this->actingAs($user)->post(route('Report.thongke_ruttien'), $data);
        //  dd($response->getContent());
         $response->assertStatus(200);
         $response->assertStatus(200)->assertJson([
            'status' => 1,
            'message' => 'Tạo báo cáo thành công TNP đã gửi báo cáo về mail của bạn',
        ]);

        // $response->assertStatus(200)->assertViewIs('admincp.admin_page.admin_xetduyet_tacpham');
    }
}
