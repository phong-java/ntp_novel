<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Novel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

    public function test_novel_it_success_to_create()
    { 

        Storage::fake('avatars');
 
 
        // $response = $this->post('/avatar', [
        //     'avatar' => $file,
        // ]);
        $user = User::factory() ->create(['sRole' => 'admin']);
        $file = [];
        $filePdf = [];
        // $file = UploadedFile::fake()->image('avatar.jpg')->size(100);
        // $filePdf =UploadedFile::fake()->create(
        //     'document.pdf', $sizeInKilobytes, 'application/pdf'
        // );
        // Arrange
        $data = [
            'anhbia' => '123456',
            'tentruyen' => 'Thêm mới truyện',
            'motatruyen' => '',
            'tiendo' => '1',
            'theloai' => '537',
            'banquyen' => $filePdf,
        ];

        // Act
        $response = $this->actingAs($user)->postJson(route('Novel.store'), $data);

        // Assert
        $response->assertStatus(200)->assertJson([
            'message' => 'Thêm truyện thành công',
            'status' => 1
        ]);
        // $response->assertJsonValidationErrors(['trangthai']);
        $this->assertDatabaseHas('tblnovel', [
            'anhbia' => 'Success category 2',
            'tentruyen' => 'success',
            'motatruyen' => '112345',
            'tiendo' => '1',
            'theloai' => '537',
            'banquyen' => '112345',
        ]);
    }
    public function test_novel_it_fail_to_create()
    { 

        Storage::fake('avatars');
 
 
        // $response = $this->post('/avatar', [
        //     'avatar' => $file,
        // ]);
        $user = User::factory() ->create(['sRole' => 'admin']);
        $file = [];
        $filePdf = [];
        // $file = UploadedFile::fake()->image('avatar.jpg')->size(100);
        // $filePdf =UploadedFile::fake()->create(
        //     'document.pdf', $sizeInKilobytes, 'application/pdf'
        // );
        // Arrange
        $data = [
            'anhbia' => '123456',
            'tentruyen' => 'Thêm mới truyện',
            'motatruyen' => '',
            'tiendo' => '1',
            'theloai' => '537',
            'banquyen' => $filePdf,
        ];

        // Act
        $response = $this->actingAs($user)->postJson(route('Novel.store'), $data);

        // Assert
        $response->assertStatus(200)->assertJson([
            'message' => 'Thêm truyện thành công',
            'status' => 1
        ]);
        // $response->assertJsonValidationErrors(['trangthai']);
        $this->assertDatabaseHas('tblnovel', [
            'anhbia' => 'Success category 2',
            'tentruyen' => 'success',
            'motatruyen' => '112345',
            'tiendo' => '1',
            'theloai' => '537',
            'banquyen' => '112345',
        ]);
    }
    public function test_novel_it_success_to_pass()
    { 

        $user = User::factory() ->create(['sRole' => 'admin']);

        $data = [
            'xuly_novel' => '12',
            'trangthai_novel' => '122',
        ];

        // Act
        $response = $this->actingAs($user)->postJson(route('Novel.xetduyet', 134), $data);

        // Assert
        $response->assertStatus(200)->assertJson([
            'message' => 'Cập nhật thành công',
            'status' =>1
        ]);
    }
    public function test_novel_ít_success_to_list()
    { 
        $user = User::factory() ->create(['sRole' => 'admin']);
        $response = $this->actingAs($user)->get('/Danh_sach_truyen');
        //  dd($response->getContent());
         $response->assertStatus(200);

        $response->assertStatus(200)->assertViewIs('admincp.admin_page.admin_xetduyet_tacpham');
    }

}

