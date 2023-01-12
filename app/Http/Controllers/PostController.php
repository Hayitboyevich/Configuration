<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentFile;
use App\Models\Link;
use App\Models\Management;
use App\Models\News;
use App\Models\NewsFile;
use App\Models\RegionalDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\ManifestElement;

class PostController extends Controller
{
    public $region_id = 1;
    public $status = 0;
    public $is_main = null;

    public function management()
    {
        $query = DB::table('posts')->select('*')->where('group', 'manage')->get();

        foreach ($query as $item) {
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->first();

            $title = unserialize($item->title);
            $position = unserialize($item->category_title);
            $reception = unserialize($item->content_html);
            if ($item->status == 'active') {
                $this->status = 1;
            }
            if (isset($title['uz'])){
                $management = new Management();
                $management->name_uz = $title['uz'] ?? null;
                $management->name_oz = $title['oz'] ?? null;
                $management->name_ru = $title['ru'] ?? null;
                $management->name_en = $title['en'] ?? null;
                $management->email = $item->option_2 ?? null;
                $management->phone_number = $item->option_3 ?? null;
                $management->position_uz = $position['uz'] ?? null;
                $management->position_oz = $position['oz'] ?? null;
                $management->position_ru = $position['ru'] ?? null;
                $management->position_en = $position['en'] ?? null;
                $management->reception_day_uz = $reception['uz'] ?? null;
                $management->reception_day_oz = $reception['oz'] ?? null;
                $management->reception_day_ru = $reception['ru'] ?? null;
                $management->reception_day_en = $reception['en'] ?? null;
                $management->img = $image->url ?? null;
                $management->region_id = $this->region_id ?? null;
                $management->status = $this->status;
                $management->save();
            }
        }
    }

    public function news()
    {
        $query = DB::table('posts')->select('*')->where('group', 'news')->get();

        foreach ($query as $item) {
            $title = unserialize($item->title);
            $content = unserialize($item->content);
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', 1)->first();
            $images = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', '0')->get();
            if (!empty($image->url)){
                $this->is_main = 1;
            }
            if ($item->status == 'active') {
                $this->status = 1;
            }
            $news = new News();
            $news->title_uz = $title['uz'] ?? null;
            $news->title_oz = $title['oz'] ?? null;
            $news->title_ru = $title['ru'] ?? null;
            $news->title_en = $title['en'] ?? null;
            $news->content_uz = $content['uz'] ?? null;
            $news->content_oz = $content['oz'] ?? null;
            $news->content_ru = $content['ru'] ?? null;
            $news->content_en = $content['en'] ?? null;
            $news->view_count = $item->views ?? null;
            $news->alias_uz = $item->alias_uz ?? null;
            $news->alias_ru = $item->alias_ru ?? null;
            $news->alias_en = $item->alias_en ?? null;
            $news->alias_oz = $item->alias_oz ?? null;
            $news->date = $item->created_on ?? null;
            $news->banner = $image->url ?? null;
            $news->on_main = $this->is_main;
            $news->region_id = $this->region_id;
            $news->status = $this->status;
            if ($news->save())
            {
                foreach ($images as $image) {
                    if ($image->status_m == 'active'){
                        $this->status = 1;
                    }
                    $newsFile = new NewsFile();
                    $newsFile->news_id = $news->id;
                    $newsFile->file = $image->url;
                    $newsFile->status = $this->status;
                    $newsFile->save();
                }
            }


        }
    }

    public function incident()
    {
        $query = DB::table('posts')->select('*')->where('group', 'events')->get();


        foreach ($query as $item) {
            $title = unserialize($item->title);
            $content = unserialize($item->content);
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', 1)->first();
            $images = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', '0')->get();
            if (!empty($image->url)){
                $this->is_main = 1;
            }
            if ($item->status == 'active') {
                $this->status = 1;
            }
            $incident = new Incident();
            $incident->title_uz = $title['uz'] ?? null;
            $incident->title_oz = $title['oz'] ?? null;
            $incident->title_ru = $title['ru'] ?? null;
            $incident->title_en = $title['en'] ?? null;
            $incident->content_uz = $content['uz'] ?? null;
            $incident->content_oz = $content['oz'] ?? null;
            $incident->content_ru = $content['ru'] ?? null;
            $incident->content_en = $content['en'] ?? null;
            $incident->view_count = $item->views;
            $incident->alias_uz = $item->alias_uz ?? null;
            $incident->alias_ru = $item->alias_ru ?? null;
            $incident->alias_en = $item->alias_en ?? null;
            $incident->alias_oz = $item->alias_oz ?? null;
            $incident->date = $item->created_on;
            $incident->banner = $image->url ?? null;
            $incident->on_main = $this->is_main;
            $incident->region_id = $this->region_id;
            $incident->status = $this->status;
            if ($incident->save())
            {
                foreach ($images as $image) {
                    if ($image->status_m == 'active'){
                        $this->status = 1;
                    }
                    $incidentFile = new IncidentFile();
                    $incidentFile->incident_id = $incident->id;
                    $incidentFile->file = $image->url;
                    $incidentFile->status = $this->status;
                    $incidentFile->save();
                }
            }


        }
    }

    public function links()
    {
        $query = DB::table('posts')->select('*')->where('group', 'site_links')->get();

        foreach ($query as $item) {
            $title = unserialize($item->title);
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->first();
            if ($item->status == 'active') {
                $this->status = 1;
            }
            $link = new Link();
            $link->title_uz = $title['uz'] ?? null;
            $link->title_oz = $title['oz'] ?? null;
            $link->title_ru = $title['ru'] ?? null;
            $link->title_en = $title['en'] ?? null;
            $link->url_uz = $item->option_2 ?? null;
            $link->url_oz = $item->option_2 ?? null;
            $link->url_ru = $item->option_2 ?? null;
            $link->url_en = $item->option_2 ?? null;
            $link->img = $image->url ?? null;
            $link->region_id = $this->region_id;
            $link->status = $this->status;
           $link->save();


        }
    }

    public function regional()
    {
        $query = DB::table('posts')->select('*')->where('group', 'map')->get();
        foreach ($query as $item) {

            $title = unserialize($item->title);
            $position = unserialize($item->category_title);
            $reception = unserialize($item->content_html);
            $address = unserialize($item->option_4);
            $content = unserialize($item->content);
            $coordinate = explode(',', $item->option_5);
            if ($item->status == 'active') {
                $this->status = 1;
            }
            if (isset($title['uz'])){
                $regional = new RegionalDivision();
                $regional->title_uz = $title['uz'] ?? null;
                $regional->title_oz = $title['oz'] ?? null;
                $regional->title_ru = $title['ru'] ?? null;
                $regional->title_en = $title['en'] ?? null;
                $regional->position_uz = $position['uz'] ?? null;
                $regional->position_oz = $position['oz'] ?? null;
                $regional->position_ru = $position['ru'] ?? null;
                $regional->position_en = $position['en'] ?? null;
                $regional->reception_day_uz = $reception['uz'] ?? null;
                $regional->reception_day_oz = $reception['oz'] ?? null;
                $regional->reception_day_ru = $reception['ru'] ?? null;
                $regional->reception_day_en = $reception['en'] ?? null;
                $regional->address_uz = $address['uz'] ?? null;
                $regional->address_oz = $address['oz'] ?? null;
                $regional->address_ru = $address['ru'] ?? null;
                $regional->address_en = $address['en'] ?? null;
                $regional->content_uz = $content['uz'] ?? null;
                $regional->content_oz = $content['oz'] ?? null;
                $regional->content_ru = $content['ru'] ?? null;
                $regional->content_en = $content['en'] ?? null;
                $regional->email = $item->option_2 ?? null;
                $regional->phone_number = $item->option_3 ?? null;
                $regional->map_id = $item->option_1 ?? null;
                $regional->map_coordinate_x = $coordinate[0] ?? null;
                $regional->map_coordinate_y = $coordinate[1] ?? null;
                $regional->alias = $item->alias ?? null;
                $regional->region_id = $this->region_id ?? null;
                $regional->status = $this->status;
                $regional->save();
            }
        }
    }
}
