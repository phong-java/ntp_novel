<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Novel;

class NovelTest extends TestCase
{
    public function test_novel_create()
    {
        
        $data = [
            'sCover'=>'',
            'sNovel'=>'chuyện garen',
            'sDes'=>'Chuyên này test',
            'sProgress'=>'1',
            'iStatus'=>'1',
            'idUser'=>'45',
            'iLicense_Status'=>'1',
            'sLicense'=>'sdfghjk'
        ];
        $data = Novel::create($data);
        $response = $this->get(route('Novel.quan_ly_truyen',$data->id));

        // // Kiểm tra trạng thái phản hồi
        $response->assertStatus(200);
        $response->assertDontSee(_('No category found'));
    }
    public function test_novel_create_many()
    {
        $data = Novel::factory(11)->create();
          
    }
    public function test_novel_update()
    {
        $data = [
            'sCover'=>'Old',
            'sNovel'=>'chuyện garen OLD',
            'sDes'=>'Chuyên này test',
            'sProgress'=>'1',
            'iStatus'=>'1',
            'idUser'=>'45',
            'iLicense_Status'=>'1',
            'sLicense'=>'sdfghjk'
        ];
        $data = Novel::create($data);

        $updateData = [
            'sCover'=>'new',
            'sNovel'=>'chuyện garen new',
            'sDes'=>'Chuyên này test',
            'sProgress'=>'1',
            'iStatus'=>'1',
            'idUser'=>'45',
            'iLicense_Status'=>'1',
            'sLicense'=>'sdfghjk'
        ];
        $response = $this->post(route('Novel.update', $data->id), $updateData);

        $response->assertStatus(405);
    }
    public function test_novel_table()
    { 
        $response = $this->post(route('Novel.Danh_sachtruyen_tacgia'));

        $response->assertStatus(200);
    }
    public function test_novel_get_detail()
    { 
        $response = $this->get(route('Novel.chi_tiet_truyen', 109));

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access_category()
    {
        $user = User::factory() ->create();
        $response = $this->actingAs($user)->get(route('User.admin',$user->id));

        $response->assertStatus(200);
        // $response->assertRedirect('/password/reset');
    }
}

