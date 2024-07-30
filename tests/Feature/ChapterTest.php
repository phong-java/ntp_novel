<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chapter;

class ChapterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_chapter_create()
    {
        
        $data = [
            'sChapter'=>'',
            'iChapterNumber' => '4',
            'sContent' => "nội dung",
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $data = Chapter::create($data);
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
            'sChapter'=>'Old',
            'iChapterNumber' => '4',
            'sContent' => "nội dung",
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $data = Chapter::create($data);

        $updateData = [
            'sChapter'=>'New',
            'iChapterNumber' => '4',
            'sContent' => "nội dung",
            'iPublishingStatus' => '1',
            'iStatus'  => '1',
            'idNovel'  => '120',
            'icharges' => '1',
        ];
        $response = $this->post(route('Chapter.update', $data->id), $updateData);

        $response->assertStatus(405);
    }
    public function test_unauthenticated_user_cannot_access_category()
    {
        $user = User::factory() ->create();
        $response = $this->actingAs($user)->get(route('User.admin',$user->id));

        $response->assertStatus(200);
        // $response->assertRedirect('/password/reset');
    }
}
