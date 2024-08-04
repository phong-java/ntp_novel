<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chapter;
use App\Http\Controllers\ChapterController;
use Illuminate\Http\Request;

class ChapterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_chapter_create()
    {
        // input
        $data = [
            'sChapter'=>'hehehe',
            'iChapterNumber' => '1',
            'sContent' => "nội dung",
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $newChapter = Chapter::create($data);
        // out put
        $this->assertEquals('hehehe', $newChapter->sChapter);
    }
    public function test_chapter_create_many()
    {
        $data = Chapter::factory(11)->create();
          
    }
    public function test_chapter_get_detail()
    { 
        $response = $this->get(route('Chapter.page_chitiet_chuong_author', 127));

        $response->assertStatus(200);
    }
    public function test_chapter_update()
    {
        $data = [
            'sChapter'=>'Old Chapter',
            'iChapterNumber' => '4',
            'sContent' => "nội dung",
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $data = Chapter::create($data);

        $updateData = [
            'sChapter'=>'New Chapter',
            'iChapterNumber' => '45',
            'sContent' => bcrypt('password'),
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $request = Request::create('/', 'GET');
        // Act
        $controller = new ChapterController();
        $response = $controller->index($request);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        //act
        $this->post(route('Chapter.update', $data->id), $updateData);

        // Asset
        $this->assertDatabaseHas('tblchapter', ['iChapterNumber' => '45']);

         // Retrieve the user
         $response = $this->get(route('Chapter.page_chitiet_chuong_author', 1));
         $response->assertStatus(200);
         $response->assertJson(['sChapter' => 'New Chapter', 'idNovel' => '120']);
    }
    public function test_unauthenticated_user_cannot_access_category()
    {
        $user = User::factory() ->create();
        $response = $this->actingAs($user)->get(route('User.admin',$user->id));

        $response->assertStatus(200);
        // $response->assertRedirect('/password/reset');
    }
    public function test_chapter_it_success_to_create()
    {
        $user = User::factory() ->create(['sRole' => 'admin']);
        // Arrange
        $data = [
            'tenchuong'=>'Chương truyện garen',
            'noidungchuong' => "nội dung garen",
            'tinhphi' => '0',
            'tinhtrang'  => '1',
            'idNovel'  => '120',
            'giatien' => '100',
        ];

        // Act
        $response = $this->actingAs($user)->postJson(route("Chapter.store"), $data);
        dd($response->getContent());

        // Assert
        $response->assertStatus(200)->assertJson([
            'message' => 'Thêm chương truyện thành công',
                'status' => 1
        ]);
        // $response->assertJsonValidationErrors(['trangthai']);
        $this->assertDatabaseHas('tblchapter', [
            'sChapter'=>'Chương truyện garen',
            'sContent' => "nội dung garen",
            'tinhphi' => '0',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '0',
        ]);
    }
    public function test_chapter_it_fail_to_create()
    {
        $user = User::factory() ->create(['sRole' => 'admin']);
        // Arrange
        $data = [
            'tenchuong'=>'Chương truyện garen12',
            'noidungchuong' => "1234",
            'tinhphi' => '1',
            'tinhtrang'  => '1',
            'idNovel'  => '120',
            'giatien' => '0',
        ];

        // Act
        $response = $this->actingAs($user)->postJson(route("Chapter.store"), $data);
        dd($response->getContent());

        // Assert
        $response->assertStatus(200)->assertJson([
            'message' => 'Thêm chương truyện thành công',
                'status' => 1
        ]);
        // $response->assertJsonValidationErrors(['trangthai']);
        $this->assertDatabaseHas('tblchapter', [
            'sChapter'=>'Chương truyện garen',
            'sContent' => "nội dung garen",
            'tinhphi' => '0',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '0',
        ]);
    }
}
